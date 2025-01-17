<?php
include 'tp5config.php';
session_start();

// Verifier si l'utilisateur est connecte
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: tp5authentification.php');
    exit();
}

$user_id = $_SESSION['id_utilisateur'];

// Recup la categorie sélectionnee
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Construire la requete SQL en fonction de la categorie selectionnee
if ($selectedCategory) {
    $query = "SELECT * FROM produits WHERE categorie = '$selectedCategory'";
} else {
    // Si aucune catégorie n'est selectionnée, afficher tous les produits
    $query = "SELECT * FROM produits";
}

$result = mysqli_query($connection, $query);
$count = 0;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jardin.client</title>
    <link rel="stylesheet" href="tp5ecommerce.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="tp5commerce.js"></script>
    <style>
        .site-info-list {
    display: flex;
    flex-wrap: wrap; /* Permet aux elements de passer à la ligne si necessaire */
    gap: 20px; /* Espacement entre les items */
}

.site-info-item {
    flex: 1 1 30%; /* Chaque item prendra 30% de la largeur disponible */
    min-width: 250px; /* La largeur minimale de chaque élément */
    box-sizing: border-box; /* Inclure le padding et les bordures dans la largeur de l'élément */
}

.site-info-item h3 {
    font-size: 1.2em;
    color: #2c3e50;
}

.site-info-item ul {
    list-style-type: none;
    padding: 0;
}

.site-info-item ul li {
    margin-bottom: 10px;
}

.site-info-item ul li a {
    text-decoration: none;
    color: #2980b9;
}

.site-info-item ul li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>

    <header>
        <h1 id="jardin">BLOOM</h1>
        <div class="header-actions">
            <a href="tp5logout.php" id="logout">Se déconnecter</a>
            <input list="categories" id="category" name="category" placeholder="Catégories" value="<?php echo htmlspecialchars($selectedCategory); ?>">
            <datalist id="categories">
                <option value="Plantes">
                <option value="Outils">
                <option value="Pots">
                <option value="Aménagement extérieur">
            </datalist>
            <button id="panier" >Aller au panier</button>
            <script type="text/javascript">
                document.getElementById("panier").addEventListener("click", function() {
                window.location.href = "tp5panier.php"; 
                });
                document.getElementById("category").addEventListener("input", function() {
                    var selectedCategory = document.getElementById("category").value;
                    if (selectedCategory) {
                        window.location.href = "tp5ecommerce.php?category=" + selectedCategory; // Recharge avec la catégorie sélectionnée
                    } else {
                        window.location.href = "tp5ecommerce.php"; // Recharge sans filtre si aucune catégorie n'est choisie
                    }
                });
            </script>
        </div>
    </header>

    <main>
        <section class="products">
            <h2>LE STOCKE</h2>
            <div class="product-grid">
                <table id="produits">
                    <tr>
                    <?php 
                    while ($row = mysqli_fetch_array($result)) {
                        // 4 produits par ligne
                        if ($count > 0 && $count % 4 == 0) {
                             echo "</tr><tr>"; // Nouvelle ligne après 4 produits
                        }
                        echo "
                           <td>
                           <div class='product' data-categorie=''>
                           <img src='" . $row['image'] . "' alt='' 
                           data-nom='" . $row['nom'] . "' 
                           data-prix='" . $row['prix'] . "' 
                           data-description='" . $row['description'] . "' 
                           data-image='" . $row['image'] . "' 
                           onclick='afficherDetails(this)'>
                           <h3>" . $row['nom'] . "</h3>
                           <p>" . $row['prix'] . " DA</p>
                           <a href='tp5panier_post.php?id_produit=" . $row['id_produit'] . "' id='add'>+ ajouter au panier</a>
                           </div>
                           </td>
                            ";
                        $count++;
                    }
                    ?>
                    </tr>
                </table>
            </div>
        </section>
    </main>

    <aside class="recommendations">
    <h2>Informations du site</h2>
    <div class="site-info-list">
        <div class="site-info-item">
            <h3>Réseaux sociaux</h3>
            <ul>
                <li><a href="https://www.facebook.com/yourpage" target="_blank"><i class='bx bxl-facebook-square'></i>Facebook</a></li>
                <li><a href="https://www.instagram.com/yourpage" target="_blank"><i class='bx bxl-instagram'></i>Instagram</a></li>
                <li><a href="https://www.pinterest.com/yourpage" target="_blank"><i class='bx bxl-pinterest'></i>Pinterest</a></li>
            </ul>
        </div>
        <div class="site-info-item">
            <h3>Modes de paiement</h3>
            <ul>
                <li><i class='bx bxs-credit-card-alt'></i>Carte bancaire</li>
                <li><i class='bx bxl-paypal' ></i>PayPal</li>
                <li><i class='bx bx-paper-plane'></i>Virement bancaire</li>
            </ul>
        </div>
        <div class="site-info-item">
            <h3>À propos de BLOOM</h3>
            <p>BLOOM est votre destination pour des produits de jardin de qualité, allant des plantes aux outils de jardinage. Nous nous engageons à fournir des produits durables et respectueux de l'environnement, tout en vous offrant un service client de premier ordre.</p>
        </div>
    </div>
    </aside>


    <!-- Modal pour afficher les détails du produit -->
    <div id="product-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2 id="modal-title"></h2>
            <img id="modal-image" src="" alt="Image du produit" style="max-width: 100%; height: auto;">
            <p id="modal-price"></p>
            <p id="modal-description"></p>
        </div>
    </div>

</body>
</html>
