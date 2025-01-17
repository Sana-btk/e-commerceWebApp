<?php
    include("tp5config.php");
    $result = mysqli_query($connection, "SELECT * FROM utilisateurs");
    $row = mysqli_fetch_array($result);

?>
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
        <form action="tp5authentification_post.php" method="post">
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


            <button type="submit" class="btn" >Login</button>




        </form>
            <div class="register-link">
                <p>Don't have an account ? <a href="tp5register.php">Register</a></p>
            </div>
        
    </div>

</body>
<?PHP
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($username)){
            echo"Please enter a username";
        }
        elseif(empty($password)){
            echo"Please enter a password";
        }
        else{
            $hash= password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO utilisateurs (user, password)
                   VALUE ('$username','$hash')";
            mysqli_query($connection, $sql);
            echo"You are now registered !";      
        }

    }


   mysqli_close($connection);
?>
