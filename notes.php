<?php
/**
 * Page de détails des notes de mon site de conservation de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";

/**
 * Validation de l'identifiant de note
 */
$id = $_GET['id'] ?? null;

// Si rien n'a été passé en paramètre
if (null == $id) {
	$_SESSION['erreur'] = "Aucune note n'a été sélectionnée";
	header('Location: ' . PATH);
}

// Si le numéro de note n'est pas valide, retourner immédiatement à la page d'accueil
if (is_nan((int)$id)) {
	$_SESSION['erreur'] = "Cette note n'est pas valide";
	header('Location: ' . PATH);
}

/**
 * Obtention des données de la note
 */
$requete = "SELECT n.titre, n.dateajout, n.datelimite, eh.titre, n.description FROM notes n
                        LEFT JOIN eisenhower eh ON n.eisenhower_id = eh.id
                        WHERE n.id = ?";
$stmt = $mysqli->prepare($requete);

$messageErreur = '';

// Retrouver la note demandée
if ($stmt) {
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$stmt->store_result();

	if (0 == $stmt->errno) {
		$stmt->bind_result($titre_note, $dateajout_note, $datelimite_note, $importance_note, $description_note);
		$stmt->fetch();

		if (0 == $stmt->num_rows) {
			$messageErreur = "La note n'a pas été trouvée";
		}
	} else {
		$messageErreur = "Erreur lors de la réquisition de la note : code 1";
	}
} else {
	$messageErreur = "Erreur lors de la réquisition de la note : code 2";
}

// Envoyer les erreurs à l'utilisateur et arrêter tout
if ('' != $messageErreur) {
	// Retourner à la page d'accueil et afficher les erreurs au besoin
	$_SESSION['erreur'] = $messageErreur;
	header("Location: " . PATH);
	die();
}

require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";
?>
<div class="contenu note-details-container">
	<?php
	$heading = PAGE_H1;
	echo "<h2>${heading} : $titre_note</h2>";

	echo "<div class='details-note'>
                    <span><b>Date d'ajout : </b>$dateajout_note</span>
                    <span><b>Date limite : </b>$datelimite_note</span>
                    <span><b>Importance de la note : </b>" . (empty($importance_note) ? "Aucune importance" : $importance_note) . "</span>
                    <p><b>Description : </b></br>$description_note</p>
                  </div>";
	?>
</div>
<?php require_once "include/pied-page.inc" ?>
<?php require_once "include/nettoyage.inc" ?>
</div>
</div>
</body>
</html>
