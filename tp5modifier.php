<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tp5authentificatrion.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Modifier Produit</title>
</head>
<body>
    <?php
    include('tp5config.php');
    $ID = $_GET['id_produit'];
    $up = mysqli_query($connection, "SELECT * FROM produits WHERE id_produit = $ID");
    $data = mysqli_fetch_array($up);
    ?>
    <div class="wrapper">
        <form action="tp5modifier_post.php" method="post" enctype="multipart/form-data">
            <!-- Champ caché pour transmettre l'ID du produit -->
            <input type="hidden" name="id_produit" value="<?php echo $data['id_produit']; ?>">

            <div class="input-box">
                <input type="text" placeholder="Nom du produit" name="nomprod" value="<?php echo $data['nom']; ?>" required>
                <i class='bx bx-package'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Catégorie" name="cate" value="<?php echo $data['categorie']; ?>" required>
                <i class='bx bx-category'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Description" name="desc" value="<?php echo $data['description']; ?>" required>
                <i class='bx bx-text'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Prix" name="price" value="<?php echo $data['prix']; ?>" required>
                <i class='bx bx-purchase-tag-alt'></i>
            </div>
            <div>
                <input type="file" name="image">
            </div>
            <br>
            <button type="submit" class="btn" name="update">Enregistrer les modifications</button>
            <a href="tp5admin.php">Afficher tous les produits</a>
        </form>
    </div>
</body>
</html>

