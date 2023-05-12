<?php
/**
 * Page d'ajout de note de ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc"
?>
<div class="contenu ajout-note-container">
    <h2><?php echo PAGE_H1 ?></h2>
    <?php
    // initialiser les données pour remplir la liste déroulante
    $requete = "SELECT id, titre FROM eisenhower ORDER BY titre";
    $resultat = $mysqli->query($requete);

    // Vérifie si l'utilisateur est connecté, et si la page est public
    if (0 == PAGE_PUBLIC && !isset($_SESSION['code'])) {
        echo '<h4 class="erreur">Vous devez être connecté pour ajouter une note</h4>';
    } else { ?>
    <form class="formulaire-note" action="ajouter-note.php" method="post">
        <div class="titre-conteneur">
            <label for="title">Titre<span style="color: red">*</span></label>
            <input name="title" maxlength=100 type="text">
            <span class="error"> </span>
        </div>

        <div class="description-conteneur">
            <label for="description">Description<span style="color: red">*</span></label>
            <input name="description" maxlength=100 type="text">
            <span class="error"> </span>
        </div>
        
        <div class="categorie-conteneur">
            <select name="categorie">
                <?php
                // Vérifie que le résultat n'est pas faux : que la requête s'est bien exécutée
                if ($resultat) {
                    if ($mysqli->affected_rows > 0 ) {
                        echo "<option value=''>Veuillez choisir...</option>";
                        while ( $enreg = $resultat->fetch_row() ) {

                            // chaque option de la liste déroulante affichera le titre de la catégorie et retournera son id
                            echo "<option value='$enreg[0]'>$enreg[1]</option>";
                        }
                    }
                    else {
                        // le message apparaîtra à la place des options de la liste déroulante
                        echo "<option value=''>Il n'y a présentement aucune catégorie dans le système.</option>";
                    }
                }
                ?>
            </select>
            <span class="error"> </span>
        </div>

        <div class="date-conteneur">
            <label for="date">Échéance de votre note<span style="color: red">*</span></label>
            <input name="date" type="date">
            <span class="error"> </span>
        </div>

        <button type="submit">Ajouter</button>
    </form>
    <?php }?>
</div>
<?php require_once "include/pied-page.inc" ?>
<?php require_once "include/nettoyage.inc" ?>
</div>
</div>
</body>
</html>
