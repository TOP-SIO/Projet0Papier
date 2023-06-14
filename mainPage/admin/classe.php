<?php
include "../config.php";
include(ROOT_PATH. './includes/public_functions.php');

$classes = getClasses();

foreach ($classes as $class) {
    echo "<h2>Classe: " . $class['libelle'] . "</h2>";
    echo "<p>Année scolaire: " . $class['anneeScolaire'] . "</p>";

    $users = getUsersByClasse($class['id']);
    print $users;
    if (!empty($users)) {
        echo "<ul>";
        foreach ($users as $user) {
            echo "<li>ID: " . $user['id_utilisateur'] . "</li>";
            echo "<li>Nom: " . $user['nom_utilisateur'] . "</li>";
            echo "<li>Email: " . $user['email'] . "</li>";
            echo "<br>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun utilisateur trouvé pour cette classe.</p>";
    }
}

?>