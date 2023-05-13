<?php
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>

<div class="contenu formulaire-authentification-container">
    <h2><?php echo PAGE_H1?></h2>
    <form class="formulaire-authentification" method="post" action="verifier-authentification.php">
        <div class="code-conteneur">
            <label for="code" class="aligne">* Code : </label>
            <input type="text" id="code" name="code">
            <span class="error"> </span>
        </div>
        <div class="secret-conteneur">
            <label for="motdepasse" class="aligne">* Mot de passe : </label>
            <input type="password" id="motdepasse" name="motdepasse">
            <span class="error"> </span>
        </div>
        <input type="submit" id="soumettre" name="soumettre" value="Soumettre">
    </form>
</div>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>