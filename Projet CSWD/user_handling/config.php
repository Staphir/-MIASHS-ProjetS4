<?php 
// https://www.tutorialspoint.com/php/php_mysql_login.htm
//Codes de connexion à la base de données

$HTMLAllowed_Choice = 'span[style],i,b,font[style|size|color]';
$HTMLAllowed_Description = 'span[style],p[style],a[href],i,b,font[style|size|color],br';
$HTMLAllowed_Step = 'span[style],p[style],i,b,img[src|alt],font[style|size|color],ol,ul,li,br';
$HTMLAllowed_Title = 'i,b,font[style|size|color]';
$dateFormat = ' d/m/Y G:i ';

//Connexion Locale
$config_base['hote']        = "127.0.0.1";
$config_base['utilisateur'] = "root";
$config_base['motdepasse']  = "";
$config_base['nom_base']    = "projet_cswd";
$cookie_path = '/-MIASHS-ProjetS4/Projet%20CSWD/';

//Connexion Pedago
// $config_base['hote']        = "127.0.0.1";
// $config_base['utilisateur'] = "mdevreese";
// $config_base['motdepasse']  = "riEa#U%0";
// $config_base['nom_base']    = "mdevreese";
// $cookie_path = '/~mdevreese/cswd/projet2018/';

ini_set('session.cache_limiter','public');
session_cache_limiter(false);


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