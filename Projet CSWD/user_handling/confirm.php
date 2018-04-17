<?php
require_once("config.php");
$invalid_id = false; 

if (isset($_GET) && !empty($_GET)) {
    $myemail = $_GET['email'];
    $query = "SELECT id FROM user WHERE email = ? and verified = '0'";
    $result=$pdo->prepare($query);
    $result->execute(array($myemail));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row); print_r($row);

    $id = $row[0]["id"];

    if ($count == 1) {
        $query = "UPDATE user SET verified = '1' WHERE id = ?";
        $result=$pdo->prepare($query);
        $result->execute(array($id));

        header("location: register_confirmation.php?reg=2");
    } else {$invalid_id = true;}
} else {$invalid_id = true;}

if ($invalid_id) {header("location: ../index.php");}