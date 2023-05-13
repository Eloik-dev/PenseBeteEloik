/**
 * Programme pour la vérification et l'envoi au serveur des données du formulaire
 * @author Éloïk Rousseau <eloik.rousseau@gmail.com>
 */

const formulaire_jaime = document.querySelector('.formulaire-jaime');

// Extraction des valeurs
const commentaire = formulaire_jaime.querySelector('.commentaire-conteneur'); // Trouver le champ commentaire
const commentaire_erreur = commentaire.querySelector('.error'); // Trouver l'erreur du champ

// Cette variable est utilisée globalement dans le script
let erreurs_jaime = [];

/**
 * Effectuer les vérifications du commentaire pour un envoi sécuritaire au serveur
 */

// Si le formulaire a bien été trouvé
if (null != formulaire_jaime) {

    // Dès que le formulaire est envoyé, nous voulons faire une action
    formulaire_jaime.onsubmit = (e) => {
        erreurs_jaime = [];

        // Si le commentaire et/ou l'erreur du commentaire n'ont pas été trouvés dans le formulaire, il y a un problème avec le code.
        if (!commentaire || !commentaire_erreur) {
            erreurs_jaime.push("Il y a eu une erreur de notre côté, nous travaillons pour la réparer.");
            e.preventDefault();
        }

        // Valider le champ
        const commentaire_verifier = VerifierCommentaire(commentaire.querySelector('textarea').value);

        // Si le commentaire n'est pas valide, et qu'il y a des erreurs présentes, les afficher à l'utilisateur
        if (!commentaire_verifier) {
            if (erreurs_jaime.length > 0) {
                commentaire_erreur.innerHTML = erreurs_jaime;
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
    erreurs_jaime.push("Il y a eu une erreur de notre côté, nous travaillons pour la réparer.");
    commentaire_erreur.innerHTML = erreurs_jaime;
}

/**
 * Vérification de la longueur du commentaire et s'il est vide
 * @param valeur Le commentaire à vérifier
 * @returns {boolean} Vrai si le commentaire est valide, sinon faux
 * @constructor
 */
const VerifierCommentaire = (valeur) => {
    if (valeur === "") {
        erreurs_jaime.push("Un commentaire est requis pour l'envoi");
        return false;
    }

    if (valeur.length > 500) {
        erreurs_jaime.push("Le commentaire ne peut être plus long que 500 caractères")
        return false;
    }
    return true;
}