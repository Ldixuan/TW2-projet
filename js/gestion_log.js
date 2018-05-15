window.addEventListener('load', initState);
window.addEventListener('load', initLog);
var currentUser;
var timer;

/**
 * Initialise l'état de la page
 */
function initState() {
    if (document.body.dataset.personne) {
        let personne = JSON.parse(document.body.dataset.personne);
        etatConnecte(personne);
    } else {
        etatDeconnecte();
    }
}

/**
 * Passe dans l'état déconnecté
 */
function etatDeconnecte() {
    // cache ou montre les éléments
    for (let elt of document.querySelectorAll('.connecte')) {
        if (elt.id == "info_profil")
        {
            elt.style.display = "none";
        }
        elt.hidden = true;
    }
    for (let elt of document.querySelectorAll('.deconnecte')) {
        if (elt.id == "div_login" || elt.id == "div_inscrire") {
            elt.style.display = "flex";
        }

        elt.hidden = false;
    }
    // nettoie la partie personnalisée :
    currentUser = null;
    delete(document.body.dataset.personne);
    //document.getElementById("avatar").src = "";
    //document.querySelector("#div_find_mes_abonnements .resultat").textContent = "";

    // updateFindEvenementDeconnecte();
    // clearTimeout(timer);
    // timer = window.setInterval(updateFindEvenementDeconnecte, 30000);

    // switchToEventRecent();
}

/**
 * Passe dans l'état connecté
 */
function etatConnecte(personne) {
    currentUser = personne;
    // cache ou montre les éléments
    for (let elt of document.querySelectorAll('.deconnecte')) {
        if (elt.id == "div_login" || elt.id == "div_inscrire") {
            elt.style.display = "none";
        }
        elt.hidden = true;
    }

    for (let elt of document.querySelectorAll('.connecte'))
    {
        if (elt.id == "info_profil")
        {
            elt.style.display = "flex";
        }
        elt.hidden = false;
    }

    // personnalise le contenu
    document.querySelector('#info_login').innerHTML = personne.login;

    // mets en dataset du body le pseudo de la personne
    let body = document.getElementsByTagName("body")[0];
    if (typeof body.dataset.personne === 'undefined') {
        body.dataset.personne = personne;
    }

}

/**
 * Mise en place des gestionnaires sur le formulaire de login et le bouton logout
 */
function initLog() {
    /* login */
    document.forms.form_login.addEventListener('submit', sendLogin);
    document.forms.form_login.addEventListener('input', function () {
        this.message.value = '';
    });

    /* create user */
    document.forms.form_inscrire.addEventListener('submit', sendCreateUtilisateur);
    document.forms.form_inscrire.addEventListener('input', function () {
        this.message.value = '';
    });

    /* logout */
    document.querySelector('#button_logout').addEventListener('click', sendLogout);
}

/**
 * Gestionnaire de l'événement submit sur le formulaire de création de compte
 */
function sendCreateUtilisateur(ev) {
    ev.preventDefault();
    let formData = new FormData(this);
    let url = this.action+'?'+formDataToQueryString(formData);
    fetchFromJson(url)
        .then(processAnswer)
        .then(etatConnecte, errorCreateUtilisateur);
}

function errorCreateUtilisateur(error) {
    document.forms.form_inscrire.message.value = 'échec 1: ' + error;
}

/**
 * Gestionnaire de l'évènement submit sur le formulaire de login
 */
function sendLogin(ev) {
    ev.preventDefault();
    let formData = new FormData(this);
    let url = this.action;
    fetchFromJson(url, {
            method: 'post',
            body: formData,
            credentials: 'same-origin'
        })
        .then(processAnswer)
        .then(etatConnecte, errorLogin);
}

/**
 * Gestionnaire de l'évènement click sur le bouton logout
 */
function sendLogout(ev) {
    etatDeconnecte();
}

/**
 * Affiche un message d'erreur pour le login
 */
function errorLogin(error) {
    document.forms.form_login.message.value = 'échec : ' + error;
}
