<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="<?php echo BASE_URL."/static/css/style.css"?>">
    </head>
    <body>
        <nav class="navbar">
            <li class="list"><a href="<?php echo BASE_URL."/logout.php"?>"><img src="<?php echo BASE_URL."/static/images/disconnect.png"?>" class="thumbnail2"></a></li>
            <li class="list"><a href="<?php echo BASE_URL."/admin/gestion_systeme.php"?>">Ajouter/supprimer des machines</a></li>
            <li class="list"><a href="<?php echo BASE_URL."/admin/ajouter_document.php"?>">Déposer un document</a></li>
            <li class="list"><a href="<?php echo BASE_URL."/admin/gestion_etudiant.php"?>">Créer un compte étudiant</a></li> 
            <li class="list"><a href="<?php echo BASE_URL."/admin/classe.php"?>">Voir les classes</a></li> 
        </nav>
        <img src="<?php echo BASE_URL."/static/images/logo ecole.png"?>" class="thumbnail">
    </body>
</html>
