<?php

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";

// Obtenir les champs de connexion
$code = htmlspecialchars($_POST['code']);
$motdepasse = htmlspecialchars($_POST['motdepasse']);

$messageErreur = '';

// Vérifier que le code n'est ni nul ou vide
if (is_null($code)) {
    $messageErreur .= "Votre code ne peut être nul.</br>";
} else if (strlen($code) === 0) {
	$messageErreur .= "Votre code ne peut être vide.</br>";
}

// Vérifier que le mot de passe n'est pas nul
if (is_null($motdepasse)) {
	$messageErreur .= "Votre mot de passe ne peut être nul.</br>";
} else if (strlen($motdepasse) === 0) {
	$messageErreur .= "Votre mot de passe ne peut être vide.</br>";
}

// Voir si l'utilisateur existe et prendre ses données
$query = "SELECT prenom, nomfamille, courriel, motdepasse, actif FROM usagers WHERE code = ?;";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->store_result();

    if (0 == $stmt->errno) {
        $stmt->bind_result($prenom, $nomfamille, $courriel, $motdepasseBD, $actif);
	    $stmt->fetch();

		if ($stmt->num_rows === 0) {
			$messageErreur .= "Les informations de connexion sont invalides ou le compte n'existe pas";
		} else {
			if (password_verify($motdepasse, $motdepasseBD)) {
				$_SESSION['code'] = $code;
				$_SESSION['prenom'] = $prenom;
				$_SESSION['nomfamille'] = $nomfamille;
				$_SESSION['courriel'] = $courriel;
				$_SESSION['actif'] = $actif;

				$_SESSION['message'] = "Vous avez été authentifié avec succès!";
				$_SESSION['bienvenue'] = "Bienvenue $prenom $nomfamille";

				header('Location: ' . PATH . '/');
			} else {
				$messageErreur .= "Les informations de connexion sont invalides ou le compte n'existe pas";
			}
		}
    } else {
        $messageErreur .= "Erreur lors de la réquisition de votre compte : " . $stmt->errno;
    }
} else {
    echo_debug("Erreur lors de la requête : " . $mysqli->error);
}

require_once "include/nettoyage.inc";

if ('' != $messageErreur) {
    // Retourner à la page d'accueil et afficher les erreurs au besoin
    $_SESSION['erreur'] = $messageErreur;
}

header("Location: " . PATH . '/');