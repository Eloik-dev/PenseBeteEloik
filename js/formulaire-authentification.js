const formulaire_authentification = document.querySelector('.formulaire-authentification');

// Extraction des valeurs
const code = formulaire_authentification.querySelector('.code-conteneur');
const secret = formulaire_authentification.querySelector('.secret-conteneur');

const code_erreur = code.querySelector('.error')
const secret_erreur = secret.querySelector('.error')

let erreurs_authentification = {
    code: [],
    secret: []
}

/**
 * Effectuer les vérifications du code et du mot de passe limite pour un envoi sécuritaire au serveur
 * @param e
 */
if (null != formulaire_authentification) {
    formulaire_authentification.onsubmit = (e) => {
        erreurs_authentification = {code: [], secret: []};
        AfficherErreurs_authentification();

        const target = e.target;

        console.log("Validation de la connexion...")

        // Valider les champs
        const v1 = VerifierCode(code.querySelector('input').value);
        const v2 = VerifierSecret(secret.querySelector('input').value);

        // Vérifier si tout les champs sont valides
        if (!v1 || !v2) {
            e.preventDefault();
        }

        AfficherErreurs_authentification();
    }
}

/**
 * Réinitialise les erreurs affichées à l'écran
 */
const AfficherErreurs_authentification = () => {
    code_erreur.innerHTML = erreurs_contact.code;
    secret_erreur.innerHTML = erreurs_contact.secret;
}

/**
 * Validation du code de connexion
 * @param valeur Code en entrée
 * @returns {boolean} Si le code est valide ou non
 */
const VerifierCode = (valeur) => {
    if (valeur === "") {
        erreerreurs_authentificationurs.code.push("Le code est requis");
        return false;
    }

    if (isNaN(valeur)) {
        erreurs_authentification.code.push("Le code doit être composé de nombres seulement");
        return false;
    }

    if (valeur.length !== 7) {
        erreurs_authentification.code.push("Votre code doit être composé de 7 caractères");
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
        erreurs_authentification.secret.push("Le mot de passe est requis");
        return false;
    }

    return true;
}