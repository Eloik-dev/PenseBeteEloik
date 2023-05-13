<?php
require_once "include/configuration.inc";

// Si l'utilisateur est déjà connecté, le déconnecter et montrer la page de connexion
if (isset($_SESSION['code'])) {
    unset($_SESSION['code']);
}

session_destroy();
session_start();

$_SESSION['message'] = 'Vous avez été déconnecté avec succès';

header('Location: ' . DEVEL . '/');