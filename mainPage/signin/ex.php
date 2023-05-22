<?php
    require_once('../config.php');

    $Email= $_POST['mail'];
    $MDP_Utilisateur = $_POST['password'];
    $MDP = password_hash($MDP_Utilisateur, PASSWORD_DEFAULT);
    $sql =  "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, email, mdp_utilisateur, statut) VALUES ('Mr. Test', 'Test', $Email, $MDP, 1);";
    $result = mysqli_query($connect, $sql);
    print_r($result);
    $_SESSION['errorMessage'] = "Identifiant peut-être crée.";
    //header('location:'.BASE_URL.'/');
?>
