<?php
include('tp5config.php');

if (isset($_POST['update'])) {
    $ID = mysqli_real_escape_string($connection, $_POST['id_produit']);
    $NAME = mysqli_real_escape_string($connection, $_POST['nomprod']);
    $PRICE = mysqli_real_escape_string($connection, $_POST['price']);
    $CATE = mysqli_real_escape_string($connection, $_POST['cate']);
    $DESC = mysqli_real_escape_string($connection, $_POST['desc']);

    if (empty($ID)) {
        die("ID du produit non défini !");
    }

    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $upload_folder = __DIR__;
    $image_target = $upload_folder . '/' . $image_name;

    $image_query = '';
    if (!empty($image_name)) {
        if (move_uploaded_file($image_tmp_name, $image_target)) {
            $image_query = ", image = '$image_name'";
        } else {
            die("Erreur : Impossible de déplacer l'image.");
        }
    }

    $update = "UPDATE produits 
               SET nom = '$NAME', 
                   prix = '$PRICE', 
                   categorie = '$CATE', 
                   description = '$DESC' 
                   $image_query 
               WHERE id_produit = '$ID'";

    echo "Requête SQL : " . $update; // Debug

    if (mysqli_query($connection, $update)) {
        echo "Modification enregistrée avec succès.";
        header("Location: tp5admin.php");
    } else {
        die("Erreur SQL : " . mysqli_error($connection));
    }
}
?>
