<?php
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
?>