const formulaire_contact = document.querySelector('.formulaire-contact');

// Extraction des valeurs
const nom = formulaire_contact.querySelector('.nom-conteneur');
const courriel = formulaire_contact.querySelector('.courriel-conteneur');
const sujet = formulaire_contact.querySelector('.sujet-conteneur');
const message = formulaire_contact.querySelector('.message-conteneur');

const nom_erreur = nom.querySelector('.error')
const courriel_erreur = courriel.querySelector('.error')
const sujet_erreur = sujet.querySelector('.error')
const message_erreur = message.querySelector('.error')

let erreurs_contact = {
    nom: [],
    courriel: [],
    sujet: [],
    message: []
}

/**
 * Effectuer les vérifications du nom, du courriel, de l'objet, et du message pour un envoi sécuritaire au serveur
 * @param e
 */
if (null != formulaire_contact) {
    formulaire_contact.onsubmit = (e) => {
        erreurs_contact = {nom: [], courriel: [], sujet: [], message: []};

        console.log("Validation du formulaire...")

        // Valider les champs
        const v1 = VerifierNom(nom.querySelector('input').value);
        const v2 = VerifierCourriel(courriel.querySelector('input').value);
        const v3 = VerifierSujet(sujet.querySelector('input').value);
        const v4 = VerifierMessage(message.querySelector('textarea').value);

        // Vérifier si tout les champs sont valides
        if (!v1 || !v2 || !v3 || !v4) {
            if (erreurs_contact.nom.length > 0) nom_erreur.innerHTML = erreurs_contact.nom;
            if (erreurs_contact.courriel.length > 0) courriel_erreur.innerHTML = erreurs_contact.courriel;
            if (erreurs_contact.sujet.length > 0) sujet_erreur.innerHTML = erreurs_contact.sujet;
            if (erreurs_contact.message.length > 0) message_erreur.innerHTML = erreurs_contact.message;
            e.preventDefault();
        }
    }
}

const VerifierNom = (valeur) => {
    if (valeur === "") {
        erreurs_contact.nom.push("Le nom est requis");
        return false;
    }

    if (valeur.length < 5) {
        erreurs_contact.nom.push("Votre nom doit être composé d'au moins 5 caractères");
        return false;
    }

    return true;
}

const VerifierCourriel = (valeur) => {
    const pattern = new RegExp(/.+@.+\..{2,}/);

    if (valeur === "") {
        erreurs_contact.courriel.push("Le courriel est requis");
        return false;
    }

    if (!pattern.test(valeur)) {
        erreurs_contact.courriel.push("Le courriel est invalide")
        return false;
    }

    return true;
}

const VerifierSujet = (valeur) => {
    if (valeur === "") {
        erreurs_contact.sujet.push("Le sujet est requis");
        return false;
    }

    if (valeur.length > 100) {
        erreurs_contact.sujet.push("Le sujet ne peut être plus long que 100 caractères")
        return false;
    }

    return true;
}

const VerifierMessage = (valeur) => {
    if (valeur === "") {
        erreurs_contact.message.push("Le message est requis");
        return false;
    }

    if (valeur.length > 2000) {
        erreurs_contact.message.push("Le message ne peut être plus long que 2000 caractères")
        return false;
    }
    return true;
}