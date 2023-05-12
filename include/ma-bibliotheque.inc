<?php

/**
 * Affiche une information de débogage seulement lorsque DEVEL est à true.
 * @param String $message Information à afficher. Affichera "débogage" si ne reçoit aucun paramètre.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Utilisation : echo_debug($mysqli->error);
 * Suppositions critiques : pour un meilleur affichage, définir la classe debug dans la feuille de style.
 */
function echo_debug($message = 'débogage')
{
    if (defined('DEVEL') && DEVEL === true) {
        echo '<div class="debug">';

        if (is_array($message) || is_object($message)) {
            print_r($message);
        } else {
            echo $message;
        }

        echo '</div>';
    }
}

/**
 * Enregistre la date suivie d'une information de débogage dans le fichier journal (log) lorsque DEVEL est à true.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 *
 * Par défaut, le fichier journal est celui spécifié dans httpd.conf.
 * Peut être modifié à l'aide de la constante DEBUG_LOG_FILE.
 *     ex : $dossierRacineServeur = dirname(__FILE__, 3);
 *          define('DEBUG_LOG_FILE', $dossierRacineServeur . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR . 'mon-application-debug.log');
 *
 * Utilisation : log_debug($_POST);
 *
 * @param String $message Information à inscrire dans le journal.
 */
function log_debug($message) {

    if (defined('DEVEL') && DEVEL === true) {
        if (is_array($message) || is_object($message)) {
            $message = print_r($message, true);
        }

        if (defined('DEBUG_LOG_FILE')) {
            error_log(date("F j, Y, g:i a") . " - Message de débogage: $message" . PHP_EOL, 3, DEBUG_LOG_FILE);
        }
        else {
            error_log(date("F j, Y, g:i a") . " - Message de débogage: $message" . PHP_EOL);
        }
    }
}

/**
 * Ajoute une balise <script> pour un fichier .js qui porte le même nom que la page actuelle,
 * seulement si ce script existe.
 * @author Christiane Lagacé <christiane.lagace@hotmail.com>
 * Supposition critique : le fichier doit être placé dans le sous-dossier js/scriptspages pour pouvoir être inclus.
 * Ex : le script pour la page d'accueil sera js/scriptspages/index.js.
 *
 * @return void
 *
 */
function inclureJsPropreALaPageActuelle(){
    $dossierRacineSite = dirname(__FILE__, 2);

    // Le deuxième paramètre de basename permet de supprimer cette chaîne de la valeur retournée
    $pageActuelleSansExtension = basename( $_SERVER['SCRIPT_NAME'], '.php' );

    if ( file_exists( $dossierRacineSite . '/js/' . $pageActuelleSansExtension . '.js' ) ) {
        echo "<script src='js/$pageActuelleSansExtension.js' defer></script>";
    }
}