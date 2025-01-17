// Fonction pour afficher les détails d'un produit dans un modal
function afficherDetails(imageElement) {
    // Récupérer les informations du produit à partir des attributs data- sur l'image
    var nom = imageElement.getAttribute("data-nom");
    var prix = imageElement.getAttribute("data-prix");
    var description = imageElement.getAttribute("data-description");
    var image = imageElement.getAttribute("data-image");

    // Mettre à jour le contenu du modal
    document.getElementById("modal-title").textContent = nom;
    document.getElementById("modal-price").textContent = prix + " DA";
    document.getElementById("modal-description").textContent = description;
    document.getElementById("modal-image").src = image;

    // Afficher le modal
    document.getElementById("product-modal").style.display = "block";
}

// Fonction pour fermer le modal
function fermerModal() {
    const modal = document.getElementById("product-modal");
    modal.style.display = "none";
}



// Fonction pour afficher le panier
function afficherPanier(idUtilisateur) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `afficher_panier.php?id_utilisateur=${idUtilisateur}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const panier = JSON.parse(xhr.responseText);
            const table = document.getElementById("cadi");

            // Supprimer les anciennes lignes sauf l'en-tête
            while (table.rows.length > 1) {
                table.deleteRow(1);
            }

            // Ajouter les produits du panier dans le tableau
            panier.forEach(item => {
                const row = table.insertRow();
                row.innerHTML = `
                    <td>${item.nom}</td>
                    <td>${item.prix} €</td>
                    <td>${item.quantite}</td>
                `;
            });
        }
    };

    xhr.send();
}

// Charger le panier au démarrage pour l'utilisateur connecté (ID utilisateur exemple : 1)
document.addEventListener("DOMContentLoaded", () => {
    afficherPanier(1); // Modifier l'ID utilisateur selon le contexte
});


