<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");
$_SESSION["id_story"] = null;
$requete="SELECT * FROM story WHERE user_id = ?";
$reponse=$pdo->prepare($requete);
$reponse->execute(array($_SESSION["user_id"]));
$array_stories = $reponse->fetchAll(PDO::FETCH_ASSOC);
?>
    <section>
        <article class="card">
            <div>
                <h2>Vos histoires</h2><hr>
                <form method="post" action="story_display.php" id="form_display">
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
                            $createdon = date('M j Y G:i ', strtotime($array_stories[$i]["createdon"]));
                            $publishedon = date('M j Y G:i', strtotime($array_stories[$i]["publishedon"]));
                            $lastmodifiedon = date('M j Y G:i', strtotime($array_stories[$i]["lastmodifiedon"]));
                            $story = $array_stories[$i]["id"];
                            echo "<tr onclick='choiceStory($story)'>";
                            echo "<td>".$array_stories[$i]["title"]."</td>";
                            echo "<td>".$createdon."</td>";
                            echo "<td>".($array_stories[$i]["published"]?"Oui":"Non")."</td>";
                            echo "<td>".$publishedon."</td>";
                            echo "<td>".$array_stories[$i]["likes"]."</td>";
                            echo "<td>".$lastmodifiedon."</td></tr>";
                        } ?>
                    </table>
                </form>
                <form action='create_story.php'>
                    <input type=submit value='Créer une nouvelle histoire' style='margin-top:20px;width:auto;float:right;'>
                </form>
            </div><div  style='clear:both;'></div>
        </article>
    </section>
    <script>
        function choiceStory(id_story){
            var input_id_story = document.createElement("input");
            input_id_story.type = "hidden";
            input_id_story.name = "id_story";
            input_id_story.value = id_story;
            document.getElementById("form_display").appendChild(input_id_story);
            document.getElementById("form_display").submit();
        }
    </script>
<?php include("../footer.php"); ?>