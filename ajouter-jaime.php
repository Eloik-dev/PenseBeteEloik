<?php
/**
 * Programme d'ajout d'un commentaire dans la base de données du site
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";

// Si le commentaire est inexistant, alors l'utilisateur n'a certainement pas utilisé le formulaire adéquatement
if (!isset($_POST['commentaire'])) {
    require_once "include/entete.inc";

    echo "<span class='call-error'>Veuillez utilisez le formulaire pour cette opération</span>";

    require_once "include/pied-page.inc";
    die();
}

// Si le commentaire est vide, envoyer une erreur
if (empty($_POST['commentaire'])) {
    $_SESSION['erreur'] = "Il y a eu une erreur lors de l'envoi de votre commentaire, le commentaire ne peut être vide";
    header("Location: " . PATH);
    die();
}

// Utilisation de htmlspecialchars pour éviter l'envoi de balises HTML au serveur
$commentaire = htmlspecialchars($_POST['commentaire']);

// Vérification de la longueur du commentaire
if (mb_strlen($commentaire) > 500) {
    $_SESSION['erreur'] = "Il y a eu une erreur lors de l'envoi de votre commentaire, la longueur ne peut être supérieure à 500 caractères";
    header("Location: " . PATH);
    die();
}

/**
 * Insertion des données dans la table mentionsjaime
 */
$query = "INSERT INTO mentionsjaime (url, date, ip, commentaire) VALUES ('index.php', now(), '999.999.999.999', ?)";
$stmt = $mysqli->prepare($query);

// Vérifier que la requête a bien été préparée, sinon afficher une erreur au développeur et à l'utilisateur
if ($stmt) {
    $stmt->bind_param("s", $commentaire); // Assigner le commentaire au ?, et spécifier le type (s)
    $stmt->execute();

    /**
     * S'il n'y a pas eu d'erreur, mettre une variable de session avec un message positif.
     * S'il y a eu une erreur, faire la même chose, mais avec une erreur, et si nous sommes dans un environnement de développement,
     * afficher le message d'erreur au développeur.
     * Dans tous les cas, nous renvoyons l'utilisateur à la page d'accueil, à moins d'avoir une erreur en environnement de développement
     */
    if (0 == $stmt->errno) {
        $_SESSION['message'] = "Votre commentaire a bien été envoyé, nous vous en remerçions beaucoup!";
    } else {
        $_SESSION['erreur'] = "Il y a eu une erreur de notre côté lors de l'envoi de votre commentaire, veuillez réessayer plus tard.";
        echo_debug("Erreur lors de la création du contact : " . $stmt->errno);
    }
    header("Location: /pensebete-rousseaueloik");
} else {
    echo_debug("Erreur lors de la requête : " . $mysqli->error);
}

// Fermer la connexion à la base de données
require_once "include/nettoyage.inc";