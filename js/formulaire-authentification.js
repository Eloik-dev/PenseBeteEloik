const formulaire = document.querySelector('.formulaire-authentification-container');

// Extraction des valeurs
const code = document.querySelector('.code-conteneur');
const secret = document.querySelector('.secret-conteneur');

const code_erreur = code.querySelector('.error')
const secret_erreur = secret.querySelector('.error')

let erreurs = {
    code: [],
    secret: []
}

/**
 * Effectuer les vérifications du code et du mot de passe limite pour un envoi sécuritaire au serveur
 * @param e
 */
if (null != formulaire) {
    formulaire.onsubmit = (e) => {
        erreurs = {code: [], secret: []};
        AfficherErreurs();

        const target = e.target;

        console.log("Validation de la connexion...")

        // Valider les champs
        const v1 = VerifierCode(code.querySelector('input').value);
        const v2 = VerifierSecret(secret.querySelector('input').value);

        // Vérifier si tout les champs sont valides
        if (!v1 || !v2) {
            e.preventDefault();
        }

        AfficherErreurs();
    }
}

/**
 * Réinitialise les erreurs affichées à l'écran
 */
const AfficherErreurs = () => {
    code_erreur.innerHTML = erreurs.code;
    secret_erreur.innerHTML = erreurs.secret;
}

/**
 * Validation du code de connexion
 * @param valeur Code en entrée
 * @returns {boolean} Si le code est valide ou non
 */
const VerifierCode = (valeur) => {
    if (valeur === "") {
        erreurs.titre.push("Le code est requis");
        return false;
    }

    if (valeur.length < 7) {
        erreurs.titre.push("Votre code doit être composé d'au moins 7 caractères");
        return false;
    }

    return true;
}

/**
 * Validation du mot de passe
 * @param valeur Mot de passe en entrée
 * @returns {boolean} Si le mot de passe est valide ou non
 */
const VerifierSecret = (valeur) => {
    if (valeur === "") {
        erreurs.description.push("Le mot de passe est requis");
        return false;
    }

    return true;
}