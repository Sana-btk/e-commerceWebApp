<?php
include('tp5config.php');

if (isset($_POST['submit'])) {
    // Recup et securiser les donnees du formulaire
    $username = stripslashes(strtolower($_POST['username']));
    $password = stripslashes($_POST['password']);
    $email = stripslashes($_POST['email']);
    $adresse = stripslashes($_POST['adresse']);

    $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $adresse = htmlspecialchars($adresse, ENT_QUOTES, 'UTF-8');

    // Vérification de l'existence de l'utilisateur
    $check_user = "SELECT * FROM utilisateurs WHERE nom='$username'";
    $check_result = mysqli_query($connection, $check_user);
    $num_rows = mysqli_num_rows($check_result);

    if ($num_rows != 0) {
        $user_error = 'Nom d\'utilisateur déjà utilisé, veuillez en choisir un autre.';
        $err_s = 1;
    }

    // Validation des champs
    if (empty($username)) {
        $user_error = 'Veuillez entrer votre nom d\'utilisateur.';
        $err_s = 1;
    } elseif (strlen($username) < 6) {
        $user_error = 'Votre nom d\'utilisateur doit contenir au moins 6 caractères.';
        $err_s = 1;
    } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
        $user_error = 'Votre nom d\'utilisateur ne peut pas être un nombre.';
        $err_s = 1;
    }

    if (empty($email)) {
        $email_error = 'Veuillez entrer votre adresse e-mail.';
        $err_s = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Veuillez vérifier votre adresse e-mail.';
        $err_s = 1;
    }

    if (empty($adresse)) {
        $adresse_error = 'Veuillez entrer votre adresse.';
        $err_s = 1;
    }

    if (empty($password)) {
        $pass_error = 'Veuillez entrer votre mot de passe.';
        $err_s = 1;
    } elseif (strlen($password) < 6) {
        $pass_error = 'Votre mot de passe doit contenir au moins 6 caractères.';
        $err_s = 1;
    }

    if ($err_s == 0 && $num_rows == 0) {
        // Hashage du mot de passe avant l'insertion dans la base de données
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe, adresse, role) 
                VALUES ('$username', '$email', '$hashed_password', '$adresse', 'client')";
        mysqli_query($connection, $sql);
        header('Location: tp5authentification.php');
        exit;
    } else {
        include('tp5register.php');
    }
}

