<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 require 'phpmailer/src/Exception.php'; 
 require 'phpmailer/src/PHPMailer.php'; 
 require 'phpmailer/src/SMTP.php'; 

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$email = 'fayesarah98@gmail.com';
try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'aforpsettingeu@gmail.com'; // Your Gmail email address
    $mail->Password   = 'telvfbtxjexjtttx';   //Your App password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;  
    // $mail->SMTPAuth = false;
    $mail->SMTPAutoTLS = false; 
    // $mail->Port = 25;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
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
    <p><button class="btn btn-primary"><a href="http://localhost:8888/Projet0Papier/mainPage/renouvellementmdp.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
    <br>
    <p>If you did not request a password reset, no further action is required.</p>
   </div>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}