<?php
include('tp5config.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: tp5authentification.php');
    exit();
}

$user_id = $_SESSION['id_utilisateur']; // ID de l'utilisateur connecté

// Récupérer les produits du panier
$query = " SELECT p.nom, p.prix, c.quantite, p.id_produit 
          FROM paniers c 
          JOIN produits p ON c.id_produit = p.id_produit 
          WHERE c.id_utilisateur = '$user_id'";

$result = mysqli_query($connection, $query);

// Vérifier si la requête a échoué
if (!$result) {
    die('Erreur SQL : ' . mysqli_error($connection));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Panier</title>
    <link rel="stylesheet" href="tp5ecommerce.css">
</head>
<body>
    <header>
        <h1 id="jardin">BLOOM</h1>
        <div class="header-actions">
            <button id="home" onclick="window.location.href = 'tp5ecommerce.php';">Retour à la boutique</button>
        </div>
    </header>
    <main>
        
        <table id="cadi" border="1">
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Supprimer</th>
            </tr>

            <?php
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $totalProduit = $row['prix'] * $row['quantite'];
                $total += $totalProduit;
                echo "
                    <tr>
                        <td>" . $row['nom'] . "</td>
                        <td>" . $row['prix'] . " DA</td>
                        <td>" . $row['quantite'] . "</td>
                        <td>" . $totalProduit . " DA</td>
                        <td><a href='tp5panier_action.php?id_produit=" . $row['id_produit'] . "'>Supprimer</a></td>
                    </tr>
                ";
            }
            ?>
        </table>

        <h3>Total: <?php echo $total; ?> DA</h3>
        <button id="home" onclick="window.location.href = 'tp5checkout.php';">Valider la commande</button>
    </main>
</body>
</html>


