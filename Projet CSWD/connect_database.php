<?php //Code de connexion à la base de données du prof

//Quand martin bosse en local
$config_base['hote']        = "127.0.0.1";
$config_base['utilisateur'] = "root";
$config_base['motdepasse']  = "";
$config_base['nom_base']    = "projet_cswd";

//Quand maxime bosse en local
// $config_base['hote']        = "localhost";
// $config_base['utilisateur'] = "root";
// $config_base['motdepasse']  = "";
// $config_base['nom_base']    = "conception";

// connexion a la base de donnees
try
{
    $pdo = new PDO( "mysql:host={$config_base['hote']};
dbname={$config_base['nom_base']}",
        "{$config_base['utilisateur']}",
        "{$config_base['motdepasse']}");
// afficher les messages d'erreurs pour trouver les erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
// jeu de caracteres : UTF-8
    $pdo->query("SET NAMES utf8");
    $pdo->query("SET CHARACTER SET utf8");
}
catch (PDOException $exception)
{
    echo "Connexion  echouee : " . $exception->getMessage();
}
?>


<?php //Mon(Maxime) ancien code de connexion à la base de données
/*
    $servername = "127.0.0.1";
    $username = "mdevreese";
    $password = "riEa#U%0";
    $database = "mdevreese";
    $dbport = 3306;

    // Create connection
    $BDD = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($BDD->connect_error) {
        die("Connection failed: " . $BDD->connect_error);
    }
*/?>