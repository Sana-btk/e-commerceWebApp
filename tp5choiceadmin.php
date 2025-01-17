
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tp5authentificatrion.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Ajouter un produit</title>
</head>
<body>
    <div class="wrapper">
        <form action="tp5choiceadmin_post.php" method="post" enctype="multipart/form-data">
            <div class="input-box">
                <input type="text" placeholder="Nom du produit" name="nomprod" required>
                <i class='bx bx-package'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Catégorie" name="cate" required>
                <i class='bx bx-category'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Description" name="desc" required>
                <i class='bx bx-text'></i>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Prix" name="price" required>
                <i class='bx bx-purchase-tag-alt'></i>
            </div>
            <div>
                <input type="file" name="image" required>
            </div>
            <br>
            <button type="submit" class="btn" name="upload">STOCKER</button>
            <a href="tp5admin.php">Afficher tous les produits</a>
        </form>
    </div>
</body>
</html>
