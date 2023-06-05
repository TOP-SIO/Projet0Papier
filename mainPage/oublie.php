<html>  
<head>  
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>
<style>
  .box
 {
  width:100%;
  max-width:600px;
  background-color:#f9f9f9;
  border:1px solid #ccc;
  border-radius:5px;
  padding:16px;
  margin:0 auto;
 }
 input.parsley-success,
 select.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 select.parsley-error,
 textarea.parsley-error {
   color: #B94A48;
   background-color: #F2DEDE;
   border: 1px solid #EED3D7;
 }

 .parsley-errors-list {
   margin: 2px 0 3px;
   padding: 0;
   list-style-type: none;
   font-size: 0.9em;
   line-height: 0.9em;
   opacity: 0;

   transition: all .3s ease-in;
   -o-transition: all .3s ease-in;
   -moz-transition: all .3s ease-in;
   -webkit-transition: all .3s ease-in;
 }

 .parsley-errors-list.filled {
   opacity: 1;
 }
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
  .error{
  color: red;
  font-weight: 700;
  } 
</style>
<?php
include_once('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include ('phpmailer/scr/Exception.php');
// echo "ok";
include ('phpmailer/src/PHPMailer.php');

include ('phpmailer/scr/SMTP.php');


// function sendRegistrationEmail($email) {
//   $mail = new PHPMailer(true);
//   // $email = 'fayesarah98@gmail.com';
//   try {
//       //Server settings
//       // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//       $mail->isSMTP();                                            //Send using SMTP
//       $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//       $mail->Username   = 'aforpsettingeu@gmail.com'; // Your Gmail email address
//       $mail->Password   = 'telvfbtxjexjtttx';   //Your App password
//       $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
//       // $mail->Port       = 587;  
//       // $mail->SMTPAuth = false;
//       $mail->SMTPAutoTLS = false; 
//       $mail->Port = 25;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//       $mail->SMTPOptions = array(
//           'ssl' => array(
//           'verify_peer' => false,
//           'verify_peer_name' => false,
//           'allow_self_signed' => true
//           )
//           );
//       //Recipients
//       $mail->setFrom('aforpsettingeu@gmail.com', 'AFORP');
//       $mail->addAddress($email);     //Add a recipient
    
//       $mail->addReplyTo('aforpsettingeu@gmail.com', 'AFORP');
      
  
//       //Attachments
//      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
  
//       //Content
//       $mail->isHTML(true);                                  //Set email format to HTML
//       $mail->Subject = 'Here is the subject';
//       $mail->Body    = '<div>
//       <p><b>Hello!</b></p>
//       <p>You are recieving this email because we recieved a password reset request for your account.</p>
//       <br>
//       <p><button class="btn btn-primary"><a href="http://localhost:8888/Projet0Papier/mainPage/renouvellementmdp.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
//       <br>
//       <p>If you did not request a password reset, no further action is required.</p>
//      </div>';
//       $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
  
//       $mail->send();
//       echo 'Message has been sent';
//   } catch (Exception $e) {
//       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }
// }


if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['email'];
  $stmt = $connect->prepare("SELECT * FROM utilisateurs WHERE email=? LIMIT 1");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  // print_r($result);
  if($result->num_rows > 0)
  { 
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'aforpsettingeu@gmail.com'; // Your Gmail email address
        $mail->Password   = 'telvfbtxjexjtttx';   //Your App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->SMTPAutoTLS = false; 
        $mail->Port = 25;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
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
      echo 'Registration email sent successfully.';
  
  }
else
{
  $msg = "We can't find a user with that email address";
}
}

?>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3 align="center">Mot de passe oublié</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
       <div class="form-group">
       <label for="email">Addresse Email</label>
       <input type="text" name="email" id="email" placeholder="Entrez Email" required 
       data-parsley-type="email" data-parsley-trigg
       er="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Enoyé Lien de renouvellement de mot de passe" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>