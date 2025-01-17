<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tp5authentificatrion.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <div class="wrapper">
        <form action="tp5register_post.php" method="post">

            <div class="input-box">
                <?php if(isset($user_error)){
                    echo $user_error;
                }
                ?>
                <input type="text" placeholder="Username" name="username" >
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <?php if(isset($pass_error)){
                    echo $pass_error;
                }
                ?>
                <input type="password" placeholder="password" name="password" >
                <i class='bx bx-lock-alt'></i>
            </div>
            <div class="input-box">
                <?php if(isset($email_error)){
                    echo $email_error;
                }
                ?>
                <input type="email" placeholder="Email" name="email" >
                <i class='bx bx-envelope' ></i>
            </div>
            <div class="input-box">
                <?php if(isset($adresse_error)){
                    echo $adresse_error;
                }
                ?>
                <input type="text" placeholder="Adresse" name="adresse" >
                <i class='bx bx-home'></i>
            </div>

            
        </select><br><br>


            <button type="submit" class="btn" name="submit" value="register" >Register</button>
            <a href="tp5authentification.php">revenir</a>

        </form>
    </div>

</body>
