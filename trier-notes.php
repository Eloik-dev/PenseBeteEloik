<?php
/**
 * Page de gestion de ma liste de notes.
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

require_once "include/configuration.inc";
require_once "include/ma-bibliotheque.inc";
require_once "include/entete.inc";

?>
<div class="contenu gestion-container">
    <h2><?php echo PAGE_H1 ?></h2>
    <table>
        <tr>
            <th><a title='Trier par titre' href="?titre">Titre</a></th>
            <th><a title="Trier par date d'ajout" href="?ajout">Date d'ajout</a></th>
            <th><a title='Trier par date limite' href="?limite">Date limite</a></th>
            <th><a title='Trier par importance' href="?importance">Importance</a></th>
            <th>Action</th>
        </tr>
        <?php
        $valides = ['titre' => 'n.titre', 'ajout' => 'n.dateajout', 'limite' => 'n.datelimite', 'importance' => 'n.eisenhower_id'];
        $ordre = $valides[$_SERVER['QUERY_STRING']] ?? $valides['importance'];

        $messageErreur = '';

        // Vérifier que l'ordre d'affichage demandé est valide
        if (!in_array($ordre, $valides)) {
            $messageErreur .= "Cet ordre de recherche n'est pas valide.</br>";
        }

        // Initialiser les données pour remplir le tableau
        $requete = "SELECT n.id, n.titre as 'titre_note', n.dateajout, n.datelimite, eh.titre FROM notes n
                        LEFT JOIN eisenhower eh ON n.eisenhower_id = eh.id
                        ORDER BY {$ordre} DESC";

        $result = $mysqli->query($requete);

        // Si la requête a été effectuée avec succès
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $titre = $row['titre_note'];
                    $dateajout = $row['dateajout'];
                    $datelimite = (new DateTime($row['datelimite']))->format('Y-m-d');
                    $eisenhower_titre = $row['titre'];
                    echo "<tr>
                            <td>$titre</td>
                            <td>$dateajout</td>
                            <td>$datelimite</td>
                            <td>$eisenhower_titre</td>
                            <td>
                                <a href='" . PATH . "/notes.php?id=$id'>Details</a>
                            </td>
                          </tr>";
                }
            } else {
                echo_debug("Aucune note n'a pu être trouvée");
                die();
            }
        } else {
            echo_debug("Il y a eu une erreur lors de la requête : ");
        }
        ?>
    </table>
    <p><a class="bouton" href="formulaire-note.php">Ajouter une note</a></p>
</div>
<?php require_once "include/pied-page.inc" ?>
<?php require_once "include/nettoyage.inc" ?>
</div>
</div>
</body>
</html>
