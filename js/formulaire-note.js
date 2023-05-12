const formulaire = document.querySelector('.formulaire-note');

// Extraction des valeurs
const titre = document.querySelector('.titre-conteneur');
const description = document.querySelector('.description-conteneur');
const date = document.querySelector('.date-conteneur');

const titre_erreur = titre.querySelector('.error')
const description_erreur = description.querySelector('.error')
const date_erreur = date.querySelector('.error')

let erreurs = {
    titre: [],
    description: [],
    date: [],
}

/**
 * Effectuer les vérifications du titre, de la description, et de la date limite pour un envoi sécuritaire au serveur
 * @param e
 */
if (null != formulaire) {
    formulaire.onsubmit = (e) => {
        erreurs = {titre: [], description: [], date: []};
        AfficherErreurs();

        const target = e.target;

        console.log("Validation du formulaire...")

        // Valider les champs
        const v1 = VerifierTitre(titre.querySelector('input').value);
        const v2 = VerifierDescription(description.querySelector('input').value);
        const v3 = VerifierDate(date.querySelector('input').value);

        // Vérifier si tout les champs sont valides
        if (!v1 || !v2 || !v3) {
            e.preventDefault();
        }

        AfficherErreurs();
    }
}

/**
 * Réinitialise les erreurs affichées à l'écran
 */
const AfficherErreurs = () => {
    titre_erreur.innerHTML = erreurs.titre;
    description_erreur.innerHTML = erreurs.description;
    date_erreur.innerHTML = erreurs.date;
}

/**
 * Validation du titre
 * @param valeur Titre en entrée
 * @returns {boolean} Si le titre est valide ou non
 */
const VerifierTitre = (valeur) => {
    if (valeur === "") {
        erreurs.titre.push("Le titre est requis");
        return false;
    }

    if (valeur.length <= 5) {
        erreurs.titre.push("Votre titre doit être composé d'au moins 5 caractères");
        return false;
    }

    return true;
}

/**
 * Validation de la description
 * @param valeur Description en entrée
 * @returns {boolean} Si la description est valide ou non
 */
const VerifierDescription = (valeur) => {
    if (valeur === "") {
        erreurs.description.push("La description est requise");
        return false;
    }

    if (valeur.length > 100) {
        erreurs.description.push("La description ne peut être plus longue que 100 caractères")
        return false;
    }

    return true;
}

/**
 * Validation de la date d'échéance
 * @param valeur Date en entrée
 * @returns {boolean} Si la date est valide ou non
 */
const VerifierDate = (valeur) => {
    const echeance = new Date(valeur);
    const aujourdhui = new Date();

    if (isNaN(echeance.getTime())) {
        erreurs.date.push("La date est requise");
        return false;
    }

    if (echeance < aujourdhui) {
        erreurs.date.push("La date ne peut être dans le passé");
        return false;
    }

    return true;
}