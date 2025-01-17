<?php
// Démarrage de la session
session_start();

// Inclusion de la configuration
include('tp5config.php');

// Initialisation des variables d'erreur
$user_error = '';
$pass_error = '';
$err_s = false;

// Vérification de la connexion à la base de données
if (!$connection) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Traitement du formulaire
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($connection, strtolower(trim($_POST['username'])));
    $password = trim($_POST['password']);

    // Validation des champs
    if (empty($username)) {
        $user_error = 'Veuillez entrer votre nom d\'utilisateur.';
        $err_s = true;
    }
    if (empty($password)) {
        $pass_error = 'Veuillez entrer votre mot de passe.';
        $err_s = true;
    }

    // Si aucune erreur, vérification dans la base de données
    if (!$err_s) {
        // Préparer la requête SQL
        $stmt = $connection->prepare("SELECT id_utilisateur, nom, mot_de_passe , role FROM utilisateurs WHERE nom = ?");
        if (!$stmt) {
            die("Erreur dans la requête SQL : " . $connection->error);
        }

        // Lier les parametres et exécuter la requête
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Vérification du mot de passe
            if (password_verify($password, $row['mot_de_passe'])) {
                // Stockage des données utilisateur dans la session
                $_SESSION['username'] = $row['nom'];
                $_SESSION['id_utilisateur'] = $row['id_utilisateur'];
                $_SESSION['role'] = $row['role'];

                // Redirection basée sur le rôle
                if ($row['role'] === 'admin') {
                    header('Location: tp5admin.php');
                } else {
                    header('Location: tp5ecommerce.php'); // Page pour les clients
                }
                exit();
            } else {
                $user_error = 'Nom d\'utilisateur ou mot de passe incorrect.';
            }
        } else {
            $user_error = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
}


?>




