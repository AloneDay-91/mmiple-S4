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
        console.log("Affichage du panier");
    }
});

function afficherPanier() {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Affichage du panier
    let panierElement = document.getElementById('panier');
    panierElement.innerHTML = '';
    panier.forEach(function(jeu) {
        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${jeu.nom}</td>
            <td>${jeu.prix} €</td>
            <td>${jeu.quantite}</td>
            <td>${jeu.prix * jeu.quantite} €</td>
            <td><button class="btn btn-danger supprimerJeu" data-id="${jeu.id}">Supprimer</button></td>
        `;
        panierElement.appendChild(tr);
    });
}

function supprimerJeuPanier(){
    document.querySelectorAll('.supprimerJeu').forEach(function(button){
        button.addEventListener('click', function(){
            let id = button.getAttribute('data-id');
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let jeu = panier.find(j => j.id === id);
            if(jeu){
                jeu.quantite--;
                if(jeu.quantite === 0){
                    panier = panier.filter(j => j.id !== id);
                }
                localStorage.setItem('panier', JSON.stringify(panier));
                afficherPanier();
            }
        });
    });
}