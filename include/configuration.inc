<?php
session_start();

require_once "include/ma-bibliotheque.inc";

define('DEVEL', false);
define('LOCAL', false);
define('PATH', LOCAL ? '/pensebete-rousseaueloik' : '');

// Choisir la configuration locale si nous ne sommes pas en production
$mysqli = null;
if (LOCAL) {
    $mysqli = new mysqli("localhost", "root", "mysql", "pensebete_rousseaueloik");
} else {
    $mysqli = new mysqli("localhost", "u104533880_eloik", "Rousseau123", "u104533880_pensebete");
}

// Vérifier s'il y a des erreurs de connexion à la base de données
if ($mysqli->connect_errno) {
    echo_debug("&Eacute;chec lors de la connexion à la base de donn&eacute;es : " . $mysqli->error);
    exit();
}

// Obtenir les données de la page
$requete = "SELECT titre, description, h1, public, texte FROM pages WHERE url = ?;";
$stmt = $mysqli->prepare($requete);

$nomPage = basename($_SERVER['SCRIPT_NAME']);

// Vérifier que la page est valide
if (!isset($nomPage)) {
    echo_debug("Cette page n'est pas valide : " . $nomPage);
    exit();
}

// S'il y a eu une erreur lors de la préparation de la requête
if ($stmt) {
    $stmt->bind_param('s', $nomPage);
    $result = $stmt->execute();

    // Si la requête a été effectuée avec succès
    if ($result) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($titre, $description, $h1, $public, $texte);
            $stmt->fetch();

            define('PAGE_TITRE', $titre);
            define('PAGE_DESCRIPTION', $description);
            define('PAGE_PUBLIC', $public);
            define('PAGE_H1', $h1);
            define('PAGE_TEXTE', $texte);
        }
    } else {
        echo_debug("Il y a eu une erreur lors de la requête : " . $stmt->error);
    }
} else {
    echo_debug("Il y a eu une erreur lors de la préparation de la requête : " . $stmt->error);
}

// Afficher un code d'erreur et renvoyer l'utilisateur à la page d'accueil s'il n'est pas authentifié
if (defined('PAGE_PUBLIC') && 0 == PAGE_PUBLIC && !isset($_SESSION['code'])) {
    $_SESSION['erreur'] = "Vous devez être authentifié pour accéder à cette page. Veuillez vous connecter.";
    header('Location: /');
	die();
}

$mysqli->set_charset("utf8");