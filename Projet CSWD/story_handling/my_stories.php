<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

$requete="SELECT * FROM story WHERE user_id = ?";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($_SESSION["user_id"]));
$array_stories = $reponse->fetchAll(PDO::FETCH_ASSOC);
?>
<section>
    <article class="card">
        <div>
            <h2>Vos histoires</h2><hr>
            <table id="customers">
            <tr>
                <th>Titre</th>
                <th>Date de création</th>
                <th>Publiée</th>
                <th>Date de publication</th>
                <th>Likes</th>
                <th>Dernière modification</th>
            </tr>
            <?php
            for ($i=0; $i<count($array_stories); $i++) {
                $createdon = date('M j Y g:i A', strtotime($array_stories[$i]["createdon"]));
                $publishedon = date('M j Y g:i A', strtotime($array_stories[$i]["publishedon"]));
                $lastmodifiedon = date('M j Y g:i A', strtotime($array_stories[$i]["lastmodifiedon"]));
                echo "<tr onclick=window.location='story_display.php?story_id=".$array_stories[$i]["id"]."'>";
                echo "<td>".$array_stories[$i]["title"]."</td>";
                echo "<td>".$createdon."</td>";
                echo "<td>".($array_stories[$i]["published"]?"Oui":"Non")."</td>";
                echo "<td>".$publishedon."</td>";
                echo "<td>".$array_stories[$i]["likes"]."</td>";
                echo "<td>".$lastmodifiedon."</td></tr>";
            } ?>
        </table>
        </div>
    </article>
</section>
<?php include("../footer.php"); ?>