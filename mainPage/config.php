<?php
    define('ROOT_PATH', realpath(dirname(__FILE__)));
    define('BASE_URL', 'http://192.168.120.51');

    session_start();
    $host = 'http://192.168.120.51';
    $user = 'root';
    $passwd = '0papier';
    $bdd = 'projet_site';
    $connect = mysqli_connect($host, $user, $passwd, $bdd);

    if (!$connect){
        die("Error connecting to database: ".mysqli_connect_error());
    }
