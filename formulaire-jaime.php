<?php
/**
 * Formulaire d'ajout d'un commentaire au site web
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>

<div class="contenu formulaire-jaime-conteneur">
    <h2><?php echo PAGE_H1?></h2>
    <form class="formulaire-jaime" action="ajouter-jaime.php" method="post">
        <div class="commentaire-conteneur">
            <label for="commentaire">Écrivez votre commentaire ici<span style="color: red">*</span></label>
            <textarea name="commentaire" id="message-textarea" cols="30" rows="10"></textarea>
            <span class="error"> </span>
        </div>

        <button type="submit">Envoyer le commentaire</button>
    </form>
</div>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>
</body>
</html>
