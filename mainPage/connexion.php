<?php
    require_once('config.php');
    include(ROOT_PATH. '/includes/head_section.php');
    include(ROOT_PATH. '/includes/public_functions.php');

    $Email= cleanchamp($_POST['mail']);
    $MDP_Utilisateur = cleanchamp($_POST['password']);

    $stmt = $connect->prepare("SELECT * FROM utilisateurs WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $result1 = $result->fetch_assoc();
        if (password_verify($MDP_Utilisateur,$result1['mdp_utilisateur'])){
            $_SESSION['id_utilisateur'] = $result1['id_utilisateur'];
            $_SESSION['statut'] = $result1['statut'];
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

