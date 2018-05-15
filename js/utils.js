/** 
 * Process an answer in the form of a JSON object
 */
function processAnswer(answer) {
    if (answer.status == "ok") {
        return HEdecodeJSON(answer.result);
    } else
        throw answer.message;
}

function HEdecodeJSON(obj) {
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            var val = obj[key];
            if (Array.isArray(val)) {
                for (item of val) {
                    HEdecodeJSON(item);
                }
            } else {
                if (typeof val === 'string') {
                    obj[key] = HEdecode(val);
                }
            }
        }
    }
    return obj;
}

function HEdecode(str) {
    return str.replace(/&#(\d+);/g, function (match, dec) {
        return String.fromCharCode(dec);
    });
}


function eventToTable(resultat) {
    let list = resultat.slice();
    let table = document.createElement('table');
    let row = table.createTHead().insertRow();
    row.insertCell().textContent = "Auteur";
    row.insertCell().textContent = "Titre";
    row.insertCell().textContent = "Catégorie";
    row.insertCell().textContent = "Lieu";
    row.insertCell().textContent = "Date";
    row.insertCell().textContent = "";

    let displayedAtt = ['auteur', 'titre', 'categorie', 'ou', 'quand'];

    let body = table.createTBody();
    for (let line of list) {

        let event_id = line.id;
        let row = body.insertRow();
        row.classList.add("event_" + event_id);
        for (let x in line) {
            if (contains(displayedAtt, x)) {
                let cell = row.insertCell();
                if (x == "auteur") {
                    // display the user avatar
                    let img = document.createElement("img");
                    // on ajoute un argument qui n'est pas pris en compte, mais ça force le navigateur à
                    // recharger l'avatar si il a été changé. sans ceci, l'avatar de n'importe quel utilisateur
                    // restera le meme à moins de recharger la page
                    img.src = "services/getAvatar.php?user=" + line[x] + "&time=" + new Date().toLocaleString();
                    cell.appendChild(img);
                }

                let content = document.createElement("span");
                content.textContent = line[x];
                content.classList.add("event_content");
                cell.classList.add("event_" + x)
                cell.appendChild(content);
            }
        }

        // add a button to check for more detail
        cell = row.insertCell();
        cell.classList.add("event_detail");
        let button = document.createElement("button");
        button.textContent = "Consulter";
        button.classList.add("consult_evenement_button");
        button.dataset.event_data = JSON.stringify(line);
        button.addEventListener("click", consultEvenement);
        cell.appendChild(button);

    }
    return table;
}

function createButtonFindUtilisateur(pseudo) {
    let button = document.createElement("button");
    button.textContent = "Consulter le profil";
    button.classList.add("connecte");
    button.classList.add("find_utilisateur_button");
    button.dataset.pseudo = pseudo;
    button.addEventListener("click", sendFormFindUtilisateur);
    return button;
}

function abonnementToTable(listFromJSON) {
    // copie de la liste, nous permet de faire des modifications sans toucher le JSON
    let list = listFromJSON.slice();
    let table = document.createElement("table");
    let row = table.createTHead().insertRow();
    row.insertCell().textContent = "Catégorie";
    row.insertCell().textContent = "Mot clé";
    row.insertCell().textContent = "";

    let body = table.createTBody();
    for (let line of list) {
        let abonnement_id = line.id;
        delete line.id;
        delete line.auteur;
        let row = body.insertRow();
        row.id = "abonnement_" + abonnement_id;
        for (let x of Object.values(line)) {
            row.insertCell().textContent = x;
        }
        let cell = row.insertCell();
        let button = document.createElement("button");
        button.textContent = "Supprimer";
        button.classList.add("delete_abonnement_button");
        button.dataset.abonnementid = abonnement_id;
        button.addEventListener("click", sendFormDeleteAbonnement);
        cell.appendChild(button);
    }
    return table;
}

/**
 * Affiche les événements de manière compact
 */
function compactEventToHTML(result) {
    let res = document.createElement("div");
    res.id = "list_of_find_evenement";

    for (elt of result) {
        let section = document.createElement("section");
        section.classList.add("compact_event");
        section.id = "compact_event_" + elt.id;

        let avatar = document.createElement("img");
        avatar.src = "services/getAvatar.php?user=" + elt.auteur + "&time=" + new Date().toLocaleString();

        let text_container = document.createElement('div');
        text_container.classList.add("compact_event_text_container");

        let text_container_categorie_detail = document.createElement('div');
        text_container_categorie_detail.classList.add("compact_event_text_container_categorie_detail");

        let title = document.createElement("span");
        title.classList.add("compact_event_title");
        title.textContent = elt.titre;

        let categorie = document.createElement("span")
        categorie.classList.add("compact_event_categorie");
        categorie.textContent = capitalizeFirstLetter(elt.categorie);

        let detail = document.createElement("a")
        detail.classList.add("compact_event_detail");
        detail.textContent = "Consulter";
        detail.src = "#section_consult_evenement";
        detail.dataset.event_data = JSON.stringify(elt);
        detail.addEventListener('click', consultEvenement);

        section.appendChild(avatar);
        text_container.appendChild(title);
        text_container_categorie_detail.appendChild(categorie);
        text_container_categorie_detail.appendChild(detail);
        text_container.appendChild(text_container_categorie_detail);
        section.appendChild(text_container);
        res.appendChild(section);
    }
    return res;
}

/** Capitalize la premiere lettre */
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

/** Retourne vrai si la valeur est contenue dans l'array, sinon faux */
function contains(array, value) {
    return array.indexOf(value) > -1;
}