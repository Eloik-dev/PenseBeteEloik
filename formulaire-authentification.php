<?php
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>

<div class="contenu formulaire-authentification-container">
    <h2><?php echo PAGE_H1?></h2>
    <form class="formulaire-authentification" method="post" action="verifier-authentification.php">
        <div class="ligne-formulaire">
            <label for="code" class="aligne">* Code : </label>
            <input type="text" id="code" name="code">
        </div>
        <div class="ligne-formulaire">
            <label for="motdepasse" class="aligne">* Mot de passe : </label>
            <input type="password" id="motdepasse" name="motdepasse">
        </div>
        <div class="ligne-formulaire">
            <label class="aligne">&nbsp;</label>
            <input type="submit" id="soumettre" name="soumettre" value="Soumettre">
        </div>
    </form>
</div>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>
</body>
</html>
