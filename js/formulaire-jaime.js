/**
 * Programme pour la vérification et l'envoi au serveur des données du formulaire
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

const formulaire = document.querySelector('.formulaire-jaime');

// Cette variable est utilisée globalement dans le script
let erreurs = [];

/**
 * Effectuer les vérifications du commentaire pour un envoi sécuritaire au serveur
 */

// Si le formulaire a bien été trouvé
if (null != formulaire) {

    // Dès que le formulaire est envoyé, nous voulons faire une action
    formulaire.onsubmit = (e) => {
        const target = e.target;
        erreurs = [];

        // Extraction des valeurs
        const commentaire = target.querySelector('.commentaire-conteneur'); // Trouver le champ commentaire
        const commentaire_erreur = commentaire.querySelector('.error'); // Trouver l'erreur du champ

        // Si le commentaire et/ou l'erreur du commentaire n'ont pas été trouvés dans le formulaire, il y a un problème avec le code.
        if (!commentaire || !commentaire_erreur) {
            erreurs.push("Il y a eu une erreur de notre côté, nous travaillons pour la réparer.");
            e.preventDefault();
        }

        // Valider le champ
        const commentaire_verifier = VerifierCommentaire(commentaire.querySelector('textarea').value);

        // Si le commentaire n'est pas valide, et qu'il y a des erreurs présentes, les afficher à l'utilisateur
        if (!commentaire_verifier) {
            if (erreurs.length > 0) {
                commentaire_erreur.innerHTML = erreurs;
            }

            // Si tout va mal, nous arrêtons l'envoi
            e.preventDefault();
        }
    }
} else {
    /**
     * Si le formulaire n'a pas été trouvé, alors un petit programmeur intrépide a peut-être
     * envoyé du mauvais code en production, nous devons donc aviser l'utilisateur que plus tard,
     * une mise à jour réparera son problème.
     */
    erreurs.push("Il y a eu une erreur de notre côté, nous travaillons pour la réparer.");
    commentaire_erreur.innerHTML = erreurs;
}

/**
 * Vérification de la longueur du commentaire et s'il est vide
 * @param valeur Le commentaire à vérifier
 * @returns {boolean} Vrai si le commentaire est valide, sinon faux
 * @constructor
 */
const VerifierCommentaire = (valeur) => {
    if (valeur === "") {
        erreurs.push("Un commentaire est requis pour l'envoi");
        return false;
    }

    if (valeur.length > 500) {
        erreurs.push("Le commentaire ne peut être plus long que 500 caractères")
        return false;
    }
    return true;
}