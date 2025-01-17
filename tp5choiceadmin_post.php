<?php
include('tp5config.php');
if (isset($_POST['upload'])) {
    $NAME = mysqli_real_escape_string($connection, $_POST['nomprod']);
    $PRICE = mysqli_real_escape_string($connection, $_POST['price']);
    $CATE = mysqli_real_escape_string($connection, $_POST['cate']);
    $DESC = mysqli_real_escape_string($connection, $_POST['desc']);
    
    // Gestion de l'image
    $image_name = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $upload_folder = __DIR__; // Dossier courant (C:\xampp\htdocs\brocode\)

    // Chemin cible pour l'image
    $image_target = $upload_folder . '/' . $image_name;

    // Déplacer l'image telechargee
    if (move_uploaded_file($image_tmp_name, $image_target)) {
        echo "Image uploadée avec succès : $image_target";

        // Insérer dans la base de donnees
        $query = "INSERT INTO produits (nom, prix, categorie, description, image) VALUES ('$NAME', '$PRICE', '$CATE', '$DESC' , '$image_name')";
        if (mysqli_query($connection, $query)) {
            header('Location: tp5choiceadmin.php');
        } else {
            echo "Erreur lors de l'insertion : " . mysqli_error($connection);
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
    }
}
?>

