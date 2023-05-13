<?php
/**
 * Page de notifications concernant ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>
<div class="contenu">
    <h2><?php echo PAGE_H1?></h2>
    <div class="notifications">
        <?php
        $requete = "SELECT note_id, moment FROM notifications ORDER BY moment;";
        $resultat = $mysqli->query($requete);

        if ($resultat) { // Si $resultat n'est pas faux
            if ($mysqli->affected_rows > 0) { // Si la requête obtient des données
                while ($data = $resultat->fetch_row()) {
                    echo "<div class='unenotification'><div><h2>Notification : $data[0]</h2><span class='date'>Moment : " . date('Y-m-d à H\hi', strtotime($data[1])) . "</span></div><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid consequuntur culpa inventore ipsa magni maxime soluta? Corporis cum eos quae quam quidem quisquam, soluta? Accusantium ad at dicta modi voluptatibus.</p></div>";
                }
            } else {
                echo "<h2>Aucunes notifications en ce moment, revenez plus tard!</h2>";
            }
        } else {
            echo "<h2 class='erreur'>Il y a eu une erreur lors du téléchargement des notifications.</h2>";
        }
        ?>
    </div>
</div>
<?php require "include/pied-page.inc" ?>
</div>
</div>