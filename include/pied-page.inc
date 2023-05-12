<?php
/**
 * Pied de page du site
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

$year = date("Y");
?>
<footer>
    <div class="liens-sociaux">
        <a href="formulaire-jaime.php" id="aimeznous">Aimez-nous <i class="fa-solid fa-heart"></i></a>
        <a href="#" target="_blank"><i class="fa-brands fa-lg fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fa-brands fa-lg fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fa-brands fa-lg fa-instagram"></i></a>
        <a href="#" target="_blank"><i class="fa-brands fa-lg fa-linkedin"></i></a>
    </div>
    <p class="copyright"><?php echo "Éloïk Rousseau - $year" ?></p>
</footer>
<?php
require_once "nettoyage.inc";