<?php
/**
 * Page principale de ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>

<div class="contenu">
    <?php
    // Afficher le message s'il est présent
    if (isset($_SESSION['message'])) {
        echo "<h4 class='success'>" . $_SESSION['message'] . "</h4>";
        unset($_SESSION['message']);
    }

    // Afficher l'erreur si elle est présente
    if (isset($_SESSION['erreur'])) {
        echo "<h4 class='erreur'>" . $_SESSION['erreur'] . "</h4>";
        unset($_SESSION['erreur']);
    }
    ?>
    <h2><?php echo PAGE_H1?></h2>
    <p><?php echo PAGE_TEXTE?></p>
    <div class="notes">
        <?php
        $requete = "SELECT id, titre, dateajout, datelimite, description FROM notes ORDER BY dateajout DESC;";
        $resultat = $mysqli->query($requete);

        if ($resultat) { // Si $resultat n'est pas faux
            if ($mysqli->affected_rows > 0) // Si le résultat contient des données
            {
                while ($data = $resultat->fetch_row()) {
                    echo "<div class='unenote'>
                            <h3>$data[1]</h3>
                            <span class='date'>$data[2]</span>
                            <p>$data[4]</p>
                            <a href=" . PATH . "/notes.php?id=" . $data[0] . ">Détails</a>
                          </div>";
                }
            } else {
                echo "<h2>Aucunes notes n'ont été trouvées, veuillez en ajouter une nouvelle.</h2>";
            }
        } else {
            echo "<h2 class='erreur'>Il y a eu une erreur lors du téléchargement des notes, veuillez revenir plus tard.</h2>";
        }
        ?>
    </div>
    <?php

    // Si l'utilisateur est connecté, afficher le bouton d'ajout de notes
    if (isset($_SESSION['code'])) {
        echo '<p><a class="bouton" href="formulaire-note.php">Ajouter une note</a></p>
    <a class="bouton-modifier-accueil" href="formulaire-page-accueil.php">Modifier la page d\'accueil</a>';
    }
    ?>
</div>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>