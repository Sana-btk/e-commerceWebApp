<a href="tp5supprimer.php?id_produit=<?php echo $row['id_produit']; ?>" id="add">supprimer</a>

<?php

include('tp5config.php');

// Vérifier si l'ID du produit est passé dans l'URL
if (isset($_GET['id_produit'])) {
    // Assurez-vous que l'ID est un entier
    $ID = (int)$_GET['id_produit'];

    // Préparer la requête de suppression
    $stmt = $connection->prepare("DELETE FROM produits WHERE id_produit = ?");
    
    // Vérifier si la préparation a échoué
    if ($stmt === false) {
        die('Erreur de préparation de la requête : ' . mysqli_error($connection));
    }

    // Lier l'ID au paramètre de la requête
    $stmt->bind_param("i", $ID);

    // Exécuter la requête
    $stmt->execute();

    // Vérifier si un produit a été supprimé
    if ($stmt->affected_rows > 0) {
        header('Location: tp5admin.php');
        exit;
    } else {
        echo "Aucun produit trouvé à supprimer.";
    }

    // Fermer la requête
    $stmt->close();
} else {
    echo "ID non trouvé";
}

?>



