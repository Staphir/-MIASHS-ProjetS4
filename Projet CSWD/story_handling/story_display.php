<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
// require_once("../connect_database.php");

if(isset($_GET["story"])) {
    $storie_choosed = $_GET["story"];
}
$menu["title"] = "Mes histoires"; $dir = "../user_handling/";

include("../secondary_header.php");
?>


    <?php
    echo "<h1 style='text-align: center'>".$storie_choosed."</h1>";
    ?>

<footer style="font-size:12px">Ce site a été créé par Maxime Dulieu, Fannie Lothaire et Martin Devreese</footer>
</body>
</html>