<?php
    require_once('config.php');
    include(ROOT_PATH. '/includes/head_section.php');
    include(ROOT_PATH. '/includes/public_functions.php');

    $Email= cleanchamp($_POST['mail']);
    $MDP_Utilisateur = cleanchamp($_POST['password']);

    $sql =  "SELECT * FROM utilisateurs WHERE email='$Email'  LIMIT 1";
    $result = mysqli_query($connect, $sql);
    print_r($result);
    if (mysqli_num_rows($result)> 0){
        $result1 = mysqli_fetch_assoc($result);
        if (password_verify($MDP_Utilisateur,$result1['MDP_Utilisateur'])){
            if ($result1['statut'] == 1 ) {
                header('location:'.BASE_URL.'/index_formateurs.php');
            } else {
                header('location:'.BASE_URL.'/index_apprentis.php');
            }
        } else {
            $_SESSION['errorMessage'] = "L'utilisateur ou le mot de passe est invalide.";
            header('location:'.BASE_URL.'/');
        }
    }
    else {
        $_SESSION['errorMessage'] = "Veuillez entrer des identifiants valides.";
        header('location:'.BASE_URL.'/');
    }   

    function cleanchamp(string $aNettoyer) {
        global $connect;
        $propre = trim($aNettoyer);
        $propre = mysqli_real_escape_string($connect, $propre);
        return $propre;
    }
?>
