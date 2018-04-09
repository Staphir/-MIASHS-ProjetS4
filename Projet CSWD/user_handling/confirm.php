<?php
require_once("config.php");

if (!empty($_GET)) {
    $myemail = $_GET['email'];
    $query = "SELECT id FROM user WHERE Email = ? and Verified = '0'";
    $result=$pdo->prepare($query);
    $result->execute(array($myemail));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row); print_r($row);

    $id = $row[0]["id"];

    if ($count == 1) {
        $query = "UPDATE user SET Verified = '1' WHERE Id = ?";
        $result=$pdo->prepare($query);
        $result->execute(array($id));

        header("location: register_confirmation.php?reg=2");
    }
} else {header("location: ../index.php");}