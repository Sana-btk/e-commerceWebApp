
<?php
include('tp5config.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: tp5authentification.php');
    exit();
}

$user_id = $_SESSION['id_utilisateur']; // ID de l'utilisateur connecté

if (isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];

    // Supprimer le produit du panier
    $delete_query = "DELETE FROM paniers WHERE id_utilisateur = '$user_id' AND id_produit = '$id_produit'";
    mysqli_query($connection, $delete_query);

    // Rediriger vers le panier après la suppression
    header('Location: tp5panier.php');
    exit();
}
?>
