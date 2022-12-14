<?php
    session_start();
    $user = 'root';
    $password = 'root';
    $db = 'projet_site';
    $host = 'localhost';

    $success = mysqli_connect($host, $user, $password, $db);
    if (!$success){
        die("Error with the database: " . mysqli_connect_error() . " (" . mysqli_connect_errno() . ")");
    }
    $mail = $_POST["mail"];
    $pass = $_POST["password"];
    $word = md5($pass);
    mysqli_query($success, "SET NAMES UTF8");
    $result = mysqli_query($success, "SELECT * FROM utilisateurs WHERE email='$mail' LIMIT 1;");
    print_r($result);
    $result1 = mysqli_fetch_assoc($result);
    if (!$result) {
        $error = $_POST[mysqli_error($success) . "(" . mysqli_connect_errno() . ")"];
        //header('Location: index.php');
        exit();
    } elseif ($result1['email'] == $mail) {
        echo $result1['mdp_utilisateur'];
        echo $pass;
        if ($result1['mdp_utilisateur'] == $pass) {
            if ($result1['statut'] == 1 ) { 
                header('location:'.BASE_URL.'/index_apprentis.php');
            } else {
                header('location:'.BASE_URL.'/index_formateurs.php');
            }
        } else {
            echo "womp womp";
        }
    } else {
        $_SESSION['message'] = "Veuillez entrer des identifiants valides";
        echo "tessss";
        // header('location:'.BASE_URL.'/index.php');
    }
    echo $mail;

    mysqli_close($success);
?>