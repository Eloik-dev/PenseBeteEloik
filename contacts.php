<?php
/**
 * Page de mes contacts.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */
require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>
<div class="contenu mes-contacts">
    <h2><?php echo PAGE_H1 ?></h2>
    <div class="contacts">
        <?php
        $requete = "SELECT nom, email, message, date_envoi FROM contacts ORDER BY date_envoi DESC;";
        $resultat = $mysqli->query($requete);

        if ($resultat) { // Si $resultat n'est pas faux
            if ($mysqli->affected_rows > 0) // Si le résultat contient des données
            {
                while ($data = $resultat->fetch_row()) {
                    echo "<div class='message'>
                            <br>
                            <h3>$data[0]</h3>
                            <span>Envoyé par $data[1]</span>
                            <br>
                            <span>Date d'envoi: $data[3]</span>
                            <br>
                            <p>$data[2]</p>
                      </div>";
                }
            } else {
                echo "<h3>Aucun contact n'a été trouvé.</h3>";
            }
        } else {
            echo "<h3 class='erreur'>Il y a eu une erreur lors du téléchargement des contacts.</h3>";
        }
        ?>
    </div>
</div>
<?php require "include/pied-page.inc" ?>
</div>
</div>
</body>
</html>
