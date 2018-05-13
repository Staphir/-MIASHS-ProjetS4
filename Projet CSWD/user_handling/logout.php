<?php
session_start();
require_once("config.php");
if(session_destroy() && !empty($_SESSION)) {
    $query = "UPDATE user SET token = '' WHERE id = ? ;";
    $result=$pdo->prepare($query);
    $result->execute(array($_SESSION['user_id']));
    setcookie('id', '', time()-3600);
    setcookie('token', '', time()-3600);
}
header("Location: ../index.php");
?>