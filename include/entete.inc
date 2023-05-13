<!DOCTYPE html>
<html lang="fr-CA">
<head>
    <title><?php
	    require_once "include/configuration.inc";
	    require_once "include/ma-bibliotheque.inc";

        echo PAGE_TITRE?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=<?php echo "DESCRIPTION"//PAGE_DESCRIPTION?>>
    <meta name="author" content="Christiane Lagacé : https://christianelagace.com">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
    <?php
    // Inclure CSS et Javascript
    if (DEVEL) {
        echo '<link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" href="css/mes-styles.css">';
	    inclureJsPropreALaPageActuelle(); // Obtenir le fichier javascript correspondant
    } else {
        echo '<link rel="stylesheet" href="css/style.min.css">
                <script src="js/app.min.js" defer></script>';
    }
    ?>
</head>
<body>
<div class="boite mobile-shell">
    <div class="interieur">
        <header>
            <nav class="menuprincipal">
                <div class="liens-conteneur">
                    <ul>
                        <li class="actif"><a href=<?php echo PATH . "/"?>>Accueil</a></li>
                        <li><a href="<?php echo PATH . '/trier-notes.php'; ?>">Gestion</a></li>
                        <li><a href=<?php echo PATH . "/notifications.php"?>>Notifications</a></li>
                        <li class="derouleroule"><a>Plus</a><a href=<?php echo PATH . "/a-propos.php"?>>À propos de moi</a><a
                                    href="formulaire-contact.php">Me
                                contacter</a>
                    </ul>
                </div>
                <div class="message-bienvenue-conteneur">
                    <?php
                    // Si l'utilisateur a un prénom et nom, les afficher
                    if (isset($_SESSION['prenom']) && isset($_SESSION['nomfamille'])) {
                        $prenom = $_SESSION['prenom'];
                        $nom = $_SESSION['nomfamille'];

                        echo "<span>Bonjour, </span><span><b>$prenom </b></span><span><b>$nom</b></span>";
                    }
                    ?>
                </div>
                <div class="icones-conteneur">
                    <div class="icone-authentification">
                        <?php
                        // Si l'utilisateur est connecter, afficher l'icône de déconnexion, sinon afficher l'icône de connexion
                        if (isset($_SESSION['code'])) {
                            echo '<a href="deconnecter.php"><i class="fa-solid fa-lg fa-right-from-bracket"></i></a>';
                        } else {
                            echo '<a href="formulaire-authentification.php"><i class="fa-solid fa-lg fa-user"></i></a>';
                        }
                        ?>
                    </div>
                </div>
            </nav>
            <div class="entete">
                <h1>Pense-bête</h1>
                <div class="soustitre">Pour une fois, je ne vais rien oublier!</div>
            </div>
            <div class="sousentete">
                <img src="medias/commun/images/entete.png" alt="post-it"/>
            </div>
        </header>
