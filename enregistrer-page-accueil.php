<?php
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";

$contenu = $_POST['contenu'];

/**
 * Vérification des données
 */
$messageErreur = '';

// Nul
if (null == $contenu) {
	$messageErreur .= 'Le contenu de la page d\'accueil ne peut être nul.</br>';
}

// Vide
if (empty($contenu)) {
	$messageErreur .= 'Le contenu de la page d\'accueil ne peut être vide.</br>';
}

// Envoyer les messages d'erreur s'il y a lieu
if ('' != $messageErreur) {
	// Retourner à la page d'accueil et afficher les erreurs au besoin
	$_SESSION['erreur'] = $messageErreur;
	header("Location: " . PATH);
	die();
}

// Modification de la page d'accueil
$query = "UPDATE pages SET texte = ? WHERE url = 'index.php';";
$stmt = $mysqli->prepare($query);

if ($stmt) {
	$stmt->bind_param("s", $contenu);
	$stmt->execute();

	if (0 == $stmt->errno) {
		$_SESSION['message'] = 'La page d\'accueil a été modifiée avec succès';
	} else {
		$_SESSION['erreur'] = "Erreur lors de la modification de la page d'accueil : code 1";
	}
} else {
	$_SESSION['erreur'] = "Erreur lors de la modification de la page d'accueil : code 2";
}

header("Location: /");

require_once "include/nettoyage.inc";