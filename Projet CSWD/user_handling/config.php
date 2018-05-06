<!-- https://www.tutorialspoint.com/php/php_mysql_login.htm -->

<?php //Codes de connexion à la base de données

$HTMLAllowed_Choice = 'i,b,font[style|size|color]';
$HTMLAllowed_Description = 'p[style],a[href],i,b,img[src],font[style|size|color],ol,ul,li,br';
$HTMLAllowed_Step = 'p[style],i,b,img[src|alt],font[style|size|color],ol,ul,li,br';
$HTMLAllowed_Title = 'i,b,font[style|size|color]';

//Connexion Locale
$config_base['hote']        = "127.0.0.1";
$config_base['utilisateur'] = "root";
$config_base['motdepasse']  = "";
$config_base['nom_base']    = "projet_cswd";

//Connexion Pedago
// $config_base['hote']        = "127.0.0.1";
// $config_base['utilisateur'] = "mdevreese";
// $config_base['motdepasse']  = "riEa#U%0";
// $config_base['nom_base']    = "mdevreese";

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