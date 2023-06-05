<?php
include "../config.php";
	global $connect;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
     require '../phpmailer/src/Exception.php'; 
     require '../phpmailer/src/PHPMailer.php'; 
     require '../phpmailer/src/SMTP.php'; 
	if(isset($_POST['submit'])){
        $mail = new PHPMailer(true);
        // $email = 'anissbn93@gmail.com';
       
        global $email;
        global $password;
        
        $nom_utilisateur = $_POST['nom_utilisateur'];
        $email = $_POST['email'];

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890&!?%';
        $password = substr(str_shuffle($alphabet),0,8);

        $hash_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `utilisateurs`(`nom_utilisateur`, `email`, `password`,`date_debut`,`date_fin`) VALUES ('$nom_utilisateur','$email', '$hash_password', now(), DATE_ADD(now(), INTERVAL 2 YEAR))";
         fichier_login();
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
            echo "Failed: " . mysqli_error($connect );
        }

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'aforpsettingeu@gmail.com'; // Your Gmail email address
            $mail->Password   = 'telvfbtxjexjtttx';   //Your App password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            // $mail->Port       = 587;  
            // $mail->SMTPAuth = false;
            $mail->SMTPAutoTLS = false; 
            $mail->Port = 587;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->SMTPOptions = array(
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
                );
            //Recipients
            $mail->setFrom('aforpsettingeu@gmail.com', 'AFORP');
            $mail->addAddress($email);     //Add a recipient
          
             $mail->addReplyTo('aforpsettingeu@gmail.com', 'AFORP');
            
        
            //Attachments
           // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
           // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = '<div>
            <p><b>Hello!</b></p>
            <p>You are recieving this email because we recieved a password reset request for your account.</p>
            <br>
            <br>
            
           </div> ' . $password;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
       

    }
    elseif(isset($_POST['suppression'])){
        $utilisateur_selectionnee = $_POST['utilisateurs'];
       
        $sql_delete = "DELETE FROM `utilisateurs` WHERE `nom_utilisateur` = '$utilisateur_selectionnee';";
        echo $sql_delete;
        
        global $result;
        $result = mysqli_query($connect , $sql_delete);
        header("Location: ../admin/ajouter_etudiant.php");
    }

    elseif(isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        // slq injection 
        $username = stripcslashes($username);
        $password = stripcslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);

        $result = mysql_query("select * from utilisateurs where email = '$email' and password = '$password'")
                or die("Failed to query datebase".mysql_error());
        $row = mysql_fetch_array($result);
        if($row['email']== $email&& $row['password']== $password){
            echo "Login success!! Welcome ".$row['email'];
            header("Location: ajouter_etudiant_func.php?loginsuccess");
        } else {
            echo "Failed to log in";
        }
    }
function fichier_login(){
    global $email;
    global $password;
    $Ligne = "Email : ".$email."\x20 , \x20 Mot de passe : ".$password."\n";
    file_put_contents("Login_Apprentis.csv",$Ligne, FILE_APPEND);
}