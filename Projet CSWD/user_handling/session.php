<?php
require_once('config.php');
session_start();

if (isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];
    $query = "SELECT id, username FROM user WHERE username = ? ";

    $result = $pdo->prepare($query);
    $result->execute(array($user_check));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);

    $login_session = $row[0]['username'];
    $path = ($config_base['hote']=="127.0.0.1")?'http://127.0.0.1/-MIASHS-ProjetS4/Projet%20CSWD/':'https://pedagovic.uf-mi.u-bordeaux.fr/~mdevreese/cswd/projet2018/';
}
?>