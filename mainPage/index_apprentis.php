<?php
    require_once('config.php');
    include(ROOT_PATH. '/includes/head_section.php');
    include(ROOT_PATH. '/includes/public_functions.php');
?>

<?php

// Vérifier si l'utilisateur est connecté
if(!isset($_SESSION['id_utilisateur']) || !isset($_SESSION['statut'])) {
    echo "Vous devez être connecté pour voir cette page. Vous serez redirigé dans 3 secondes.";
    header("refresh:3;url=".BASE_URL.'/');
    exit();
}

// Vérifier le statut de l'utilisateur
if($_SESSION['statut'] != 0) {
    echo "Accès refusé. Vous serez redirigé dans 3 secondes.";
    header("refresh:3;url=".BASE_URL.'/index_formateurs.php');
    exit();
}

?>

    <title>Projet0Papier | Accueil</title>
    </head>

<body>
<!-- Contenu de la page -->

<article class="container">

<!-- Barre de navigation -->
<?php 
include(ROOT_PATH.'/includes/navbar_apprentis.php'); 
?>

<!-- // Barre de navigation-->


<br> <br>

<article class="rectangle-gris">
    <?php $machines = getSystems();
    foreach ($machines as $machine): ?>
    <div class="row">
        <h2><?php echo $machine['nom_systeme'] ?></h2>
        <img class="bigThumbnail" src="<?php echo BASE_URL. '/static/images/photo_machines/'. $machine['photo']?>"></br>
        <div class="row2">
            <button type="button" class="button-doc" onclick="location.href='<?php echo BASE_URL. '/systeme/'. $machine['lien']?>'">Pédago</button>
            <button type="button" class="button-doc" onclick="location.href='<?php echo BASE_URL. '/systeme/'. $machine['lien']?>'">Technique</button>
        </div>
    </div>
    <?php endforeach ?>
</div>

<!-- footer -->
 <?php   include(ROOT_PATH.'/includes/footer.php'); 
 ?>

<!-- // footer -->

</article>

    </body>

</html>
