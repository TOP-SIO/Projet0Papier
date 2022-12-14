<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Projet0Papier / GKPT</title>
        <link rel="stylesheet" href="static/css/style.css">
    </head>
    <body>
        <img src="static/images/logo ecole.png" class="thumbnail3">
            <?php
            session_start();
            $t = $_SESSION['errorMessage'];
            if($t != "") : ?>
                <nav align="center" class="Error">
                    <p class="Text2">Erreur</p> 
                    <p class="Text3"><?php echo $t ?></p> 
                </nav>
                <?php $_SESSION['errorMessage'] = "";
            endif;
        ?>
        <form action="connexion.php" method="post"> 
            <fieldset align="center">
                <p class="Text">Authentification</p> 
                <input type="email" class="required" name="mail" size="20" placeholder="Identifiant" required/>
                <input type="password" class="required" name="password" size="20" placeholder="Mot de passe" required/>
                <br/>
                <input type="submit" class="button" value='Se connecter'/>
            </fieldset>
        </form>
        <img src="static/images/logo.png" class="watermark">
    </body>
</html>