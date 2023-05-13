<?php
/**
 * Page de contact de ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";

?>

<div class="contenu contact-container">
    <h2><?php echo PAGE_H1?></h2>
    <?php
    if (isset($_SESSION['code'])) {
        echo '<a href="contacts.php">Voir tout les contacts</a>';
    }
    ?>
    <form class="formulaire-contact" action="traiter-contact.php" method="post">
        <div class="nom-conteneur">
            <label for="name">Votre nom<span style="color: red">*</span></label>
            <input name="name" maxlength=100 type="text">
            <span class="error"> </span>
        </div>

        <div class="courriel-conteneur">
            <label for="email">Votre adresse courriel<span style="color: red">*</span></label>
            <input name="email" maxlength=100 type="text">
            <span class="error"> </span>
        </div>

        <div class="sujet-conteneur">
            <label for="subject">Objet de votre message<span style="color: red">*</span></label>
            <input name="subject" type="text">
            <span class="error"> </span>
        </div>

        <div class="message-conteneur">
            <label for="message">Tapez votre message ici<span style="color: red">*</span></label>
            <textarea name="message" id="message-textarea" cols="30" rows="10"></textarea>
            <span class="error"> </span>
        </div>

        <button type="submit">Envoyer</button>
    </form>
</div>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>
