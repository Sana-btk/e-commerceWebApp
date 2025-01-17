<?php
include('tp5config.php');
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: tp5authentification.php');
    exit();
}

// Vérifier si un produit est ajouté au panier
if (isset($_GET['id_produit'])) {
    $id_produit = $_GET['id_produit'];
    $user_id = $_SESSION['id_utilisateur'];

    // Vérifier si le produit existe déjà dans le panier de l'utilisateur
    $query = "SELECT quantite FROM paniers WHERE id_utilisateur = '$user_id' AND id_produit = '$id_produit'";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Erreur SQL : ' . mysqli_error($connection));
    }

    if (mysqli_num_rows($result) > 0) {
        // Le produit est déjà dans le panier, on met à jour la quantité
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantite'] + 1;
        $update_query = "UPDATE paniers SET quantite = '$new_quantity' WHERE id_utilisateur = '$user_id' AND id_produit = '$id_produit'";
        mysqli_query($connection, $update_query);
    } else {
        // Le produit n'est pas encore dans le panier, on l'ajoute
        $insert_query = "INSERT INTO paniers (id_utilisateur, id_produit, quantite) VALUES ('$user_id', '$id_produit', 1)";
        mysqli_query($connection, $insert_query);
    }

    // Redirection vers la page du panier
    header('Location: tp5panier.php');
    exit();
}
?>


