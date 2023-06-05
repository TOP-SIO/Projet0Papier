<?php
    define('ROOT_PATH', realpath(dirname(__FILE__)));
<<<<<<< HEAD
    define('BASE_URL', 'http://localhost:8888/Projet0Papier/mainPage/');
=======
    define('BASE_URL', 'http://192.168.120.51');
>>>>>>> 774f9d254384988088e63a08df18287b979a05a1

    session_start();
    $host = 'localhost';
    $user = 'root';
    $passwd = '0Papier';
    $bdd = 'projet_site';
    $connect = mysqli_connect($host, $user, $passwd, $bdd);

    if (!$connect){
        die("Error connecting to database: ".mysqli_connect_error());
    }
