document.querySelectorAll('.ajoutJeu').forEach(function(button) {
    button.addEventListener('click', function() {
        // Récupération des données du jeu
        let id = button.getAttribute('data-id');
        let nom = button.getAttribute('data-nom');
        let prix = button.getAttribute('data-prix');

        console.log("Jeu ajouté au panier");
        // Ajout du jeu au panier
        ajouterJeu(id, nom, prix);
    });
});

function ajouterJeu(id, nom, prix) {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Vérification si le jeu est déjà dans le panier
    let jeu = panier.find(j => j.id === id);
    if (jeu) {
        jeu.quantite++;
    } else {
        panier.push({ id: id, nom: nom, prix: prix, quantite: 1 });
    }

    // Enregistrement du panier
    localStorage.setItem('panier', JSON.stringify(panier));
}

document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM chargé");
    // Récupération du panier
    // détecter si un élément avec l'id panier existe, si oui appeler la fonction afficherPanier
    if (document.getElementById('panier')) {
        afficherPanier();
        supprimerJeuPanier();
        viderPanier();
        modifierPanier();
        console.log("Affichage du panier");
    }
});

function afficherPanier() {
    let panier = JSON.parse(localStorage.getItem('panier')) || [];
    let tbody = document.getElementById('panier');
    tbody.innerHTML = '';

    panier.forEach(jeu => {
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${jeu.nom}</td>
            <td>${jeu.prix} €</td>
            <td>
                <input type="number" value="${jeu.quantite}" min="1" class="quantiteJeu" data-id="${jeu.id}">
                <button class="btn btn-primary modifierJeu" data-id="${jeu.id}">Modifier</button>
            </td>
            <td>${jeu.prix * jeu.quantite} €</td>
            <td><button class="btn btn-danger supprimerJeu" data-id="${jeu.id}">Supprimer</button></td>
        `;
        tbody.appendChild(tr);
    });

    modifierPanier(); // Réattache les événements après mise à jour du DOM
}


function supprimerJeuPanier(){
    document.querySelectorAll('.supprimerJeu').forEach(function(button){
        button.addEventListener('click', function(){
            let id = button.dataset['id'];
            supprimerJeu(id);
        });
    });
}

function viderPanier(){
    document.getElementById('viderPanier').addEventListener('click', function(){
        localStorage.removeItem('panier');
        afficherPanier();
    });
}

function modifierPanier(){
    document.querySelectorAll('.modifierJeu').forEach(function(button){
        button.addEventListener('click', function(){
            let id = button.getAttribute('data-id');
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let jeu = panier.find(j => j.id === id);
            if(jeu){
                jeu.quantite = parseInt(button.previousElementSibling.value, 10) || 1;
                localStorage.setItem('panier', JSON.stringify(panier));
                afficherPanier();
            }
        });
    });
}

function supprimerJeu(id){
    let panier = JSON.parse(localStorage.getItem('panier')) || [];
    panier = panier.filter(j => j.id !== id);
    localStorage.setItem('panier', JSON.stringify(panier));
    afficherPanier();
}