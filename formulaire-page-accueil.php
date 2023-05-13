<?php
/**
 * Page principale de ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>

<div class="contenu modification-page-accueil-container">
    <h2><?php echo PAGE_H1 ?></h2>
    <form class="formulaire-modification-accueil" action="enregistrer-page-accueil.php" method="post">
        <textarea class="tinymce" name="contenu" cols="30" rows="10">
            <?php
            // Récupération du contenu de la page d'accueil sauvegardé
            $requete = "SELECT texte FROM pages WHERE url = 'index.php'";
            $result = $mysqli->query($requete);

            // Si la requête a été effectuée avec succès
            if ($result) {
	            if ($result->num_rows > 0) {
		            $row = $result->fetch_assoc();
                    echo $row['texte'];
	            } else {
		            echo 'La page d\'accueil n\'a pas été trouvée.';
	            }
            } else {
	            echo "Il y a eu une erreur lors de la récupération de la page d'accueil";
            }
            ?>
        </textarea>
        <button type="submit">Enregistrer</button>
    </form>
</div>
<script src="https://cdn.tiny.cloud/1/gz3xbnyi1w5rls1h3674dvg6q7rmhv97a1q47k7yw29wvv62/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.tinymce',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            {value: 'First.Name', title: 'First Name'},
            {value: 'Email', title: 'Email'},
        ]
    });
</script>
<?php require_once "include/pied-page.inc" ?>
</div>
</div>