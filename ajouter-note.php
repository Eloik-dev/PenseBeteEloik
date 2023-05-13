<?php
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";

if (!isset($_POST['title'])) {
    require_once "include/entete.inc";

    echo "<span class='call-error'>Veuillez utilisez le formulaire pour cette opération</span>";

    require_once "include/pied-page.inc";

    die();
}

$titre = htmlspecialchars($_POST['title']);
$description = htmlspecialchars($_POST['description']);
$date = htmlspecialchars($_POST['date']);
$categorie = htmlspecialchars($_POST['categorie']);

$messageErreur = '';

/**
 * Vérification des données
 */
// Titre
if (null == $titre) {
    $messageErreur .= "Votre titre ne peut être nul.</br>";
} else if (strlen($titre) <= 5) {
    $messageErreur .= "Votre titre doit être composé d'au moins 5 caractères.</br>";
}

// Description
if (null == $titre) {
    $messageErreur .= "Votre description ne peut être nulle.</br>";
} else if (strlen($description) > 100) {
    $messageErreur .= "La description ne peut être plus longue que 100 caractères.</br>";
}

// Date
if (null == $date) {
    $messageErreur .= "Votre date ne peut être nulle.</br>";
} else {
    $dateLimite = (new DateTime($date))->format('Y-m-d H:i:s');
    $dateAujourdhui = (new DateTime())->format('Y-m-d H:i:s');

    if (is_null($dateLimite)) {
        $messageErreur .= "La date entrée est invalide.</br>";
    }

    if ($dateLimite < $dateAujourdhui) {
        $messageErreur .= "La date ne peut être dans le passé.</br>";
    }
}

// Validation catégorie
$requete = "SELECT id FROM eisenhower WHERE id=?;";
$stmt = $mysqli->prepare($requete);

if ($stmt) {
    $stmt->bind_param('i', $categorie);
    $stmt->execute();
    $stmt->store_result();

    if (0 == $stmt->errno) {
        if (0 == $stmt->num_rows) {
            $categorie = null;
        }
    } else {
        echo_debug($stmt->error);
        $messageErreur .= "Il n\'est pas possible de valider la catégorie (code 1).</br>";
    }


    $stmt->close();
} else {
    echo_debug($stmt->error);
    $messageErreur .= "Il n\'est pas possible de valider la catégorie (code 2).</br>";
}

// Envoi des erreurs
if ('' != $messageErreur) {
    // Retourner à la page d'accueil et afficher les erreurs au besoin
    $_SESSION['erreur'] = $messageErreur;
    header("Location: " . DEVEL . '/');
    die();
}

// Insertion des données
$query = "INSERT INTO notes (titre, dateajout, description, eisenhower_id, datelimite) VALUES (?, NOW(), ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("ssss", $titre, $description, $categorie, $dateLimite);
    $stmt->execute();

    if (0 != $stmt->errno) {
        echo_debug("Erreur lors de la création de la note : " . $stmt->error);
    }
} else {
    echo_debug("Erreur lors de la requête : " . $mysqli->error);
}

header("Location: " . DEVEL . '/');

require_once "include/nettoyage.inc";