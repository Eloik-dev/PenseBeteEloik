<?php
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";


if (empty($_POST['subject'])) {
    require_once "include/entete.inc";

    echo "<span class='call-error'>Veuillez utilisez le formulaire pour cette opération</span>";

    require_once "include/pied-page.inc";

    die();
}

$nom = htmlspecialchars($_POST['name']);
$courriel = htmlspecialchars($_POST['email']);
$objet = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);

$messageErreur = '';

/**
 * Vérification des données
 */
$exp = "/.+@.+\..{2,}/";

// Nom
if (null == $nom) {
	$messageErreur .= "Le nom ne peut être nul.</br>";
} else if (strlen($nom) <= 5) {
    $messageErreur .= "Le nom doit être composé d'au moins 5 caractères.</br>";
}

// Courriel
if (null == $courriel) {
	$messageErreur .= "Le courriel ne peut être nul.</br>";
} else if (!preg_match($exp, $courriel)) {
	$messageErreur .= "Le courriel est invalide.</br>";
}

// Sujet
if (null == $objet) {
	$messageErreur .= "Le sujet ne peut être nul.</br>";
} else if (strlen($objet) > 100) {
	$messageErreur .= "Le sujet ne peut être plus long que 100 caractères.</br>";
}

// Message
if (null == $message) {
	$messageErreur .= "Le message ne peut être nul.</br>";
} else if (strlen($message) > 1000) {
	$messageErreur .= "Le message ne peut être plus long que 1000 caractères.</br>";
}

// Insertion des données
$query = "INSERT INTO contacts (nom, email, objet, message) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($query);

if ($stmt) {
    $stmt->bind_param("ssss", $nom, $courriel, $objet, $message);
    $stmt->execute();

    if (0 != $stmt->errno) {
	    $messageErreur .= "Erreur lors de la création du contact : code 1";
    }
} else {
	$messageErreur .= "Erreur lors de la création du contact : code 2";
}

header("Location: " . PATH);

require_once "include/nettoyage.inc";