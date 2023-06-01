<?php 
include "../config.php";
/* * * * * * * * * * * * * * *
* Renvoie tous les systèmes
* * * * * * * * * * * * * * */
function getSystems() {
	// utilise l'objet global $connect  pour la connexion à la base de données
	global $connect;
	
	// construction de la requête
	$sql = "SELECT * FROM systeme";
	
	// envoie de la requete
	$result = mysqli_query($connect, $sql);
	
	// récupère tous les messages sous la forme d’un tableau $machines

	$machines = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
	return $machines;
}

/*
    Compteur nombre utilisateur étudiant
*/
function getUSer_eleve(){
    global $connect;
    
    $requete_nb_utilisateur = "SELECT COUNT(*) FROM `utilisateurs` WHERE `statut` = 0;";//améliorer
    $resultat_nbrequete = mysqli_query($connect,$requete_nb_utilisateur);
    $resultat_requete_nbuser = mysqli_fetch_all($resultat_nbrequete,MYSQLI_ASSOC);
    
    global $utilisateur;
    foreach($resultat_requete_nbuser as $nb_users){
        $utilisateur = $nb_users['COUNT(*)'];
    }

    return $utilisateur;
}

/*
    Ajout utilisateur
*/ 
function add_user()
{
	// global $connect;s
	if(isset($_POST['submit'])){
        global $email;
        global $password;
        
        $nom_utilisateur = $_POST['nom_utilisateur'];
        $email = $_POST['email'];

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890&!?%';
        $password = substr(str_shuffle($alphabet),0,8);

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `utilisateurs`(`nom_utilisateur`, `email`, `MPD_Utilisateur`,`date_debut`,`date_fin`) VALUES ('$nom_utilisateur','$email', '$hash_password', now(), DATE_ADD(now(), INTERVAL 2 YEAR))";
        
        // $result = mysqli_query($connect , $sql);
        $result = $connect->query("SELECT * FROM `utilisateurs` WHERE email='$email'");
        $row = $result->fetch_row();
        if ($row[0] > 0) {
          echo "<script>alert(\"Cet email est déjà utilisé pour un autre compte.\")</script>";
        }
        elseif($connect->query($sql) === TRUE) {
            echo "<script>alert(\"L'utilisateur a été ajouté avec succès.\")</script>";
          } 
        else {
            echo "Failed: " . mysqli_error($connect);
        }

    }
}

// {
//     global $email;
//     global $password;
//     global $connect;

//     $nom_utilisateur = $_POST['nom_utlisataeur'];
//     $email = $_POST['email'];

//     $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890&!?%';
//     $password = substr(str_shuffle($alphabet),0,8);

//     $hash_password = password_hash($password, PASSWORD_DEFAULT);

//     // fichier_login();

//     $sql = "INSERT INTO `utilisateurs`(`nom_utilisateur`, `prenom_utilisateur`, `email`, `mdp_utilisateur`, `date_debut`, `date_fin` ) VALUES ('$nom_utilisateur','$email', '$hash_password', now(), );";
//     // echo $sql;

//     $result = mysqli_query($connect , $sql);
//     return $result;

// }

/*
    Suppression utilisateur
*/ 

function delete_user(){
    global $utilisateur_selectionnee;
    global $connect;

    $utilisateur_selectionnee = $_POST['utilisateurs'];

    $sql_delete = "DELETE FROM `utilisateurs` WHERE `nom_utilisateur` = '$utilisateur_selectionnee';";
    // echo $sql_delete;
    global $result;
    $result = mysqli_query($connect , $sql_delete);
    header("Location: ../admin/ajouter_etudiant.php");
}

/*
    Fichier de login
*/

// function fichier_login(){
//     global $email;
//     global $password;
//     $Ligne = "Email : ".$email."\x20 , \x20 Mot de passe : ".$password."\n";
//     file_put_contents("Login_Apprentis.csv",$Ligne, FILE_APPEND);
// }

// Valider le  mot de passe

function check_mdp_format($MDP_Utilisateur)
    {
        $uppercase = preg_match('@[A-Z]@', $MDP_Utilisateur);
        $lowercase = preg_match('@[a-z]@', $MDP_Utilisateur);
        $number    = preg_match('@[0-9]@', $MDP_Utilisateur);
        $specialChars = preg_match('@[^\w]@', $MDP_Utilisateur);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($MDP_Utilisateur) < 12)
            {
            return false;
        }
        else{
            return true;
    }
}
?>
