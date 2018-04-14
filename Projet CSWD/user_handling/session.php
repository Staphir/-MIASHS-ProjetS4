<?php
require_once('config.php');
session_start();

if (isset($_SESSION['login_user'])) {
    $user_check = $_SESSION['login_user'];
    $query = "SELECT username FROM user WHERE username = ? ";

    $result = $pdo->prepare($query);
    $result->execute(array($user_check));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $login_session = $row[0]['username'];
}
?>