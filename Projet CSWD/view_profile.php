<?php
if (!isset($_GET['u_n']) or empty($_GET['u_n'])) {
    header('location: index.php');
}
$menu["title"] = $_GET['u_n'];
include("main_header.php");

$query = "SELECT * FROM user WHERE username = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_GET["u_n"]));
$userArray = $result->fetchAll(PDO::FETCH_ASSOC);

if (!count($userArray)) {
    header('location: index.php');
} else {
    $query = "SELECT * FROM story WHERE user_id = ? AND published = 1 ;";
    $result = $pdo->prepare($query);
    $result->execute(array($userArray[0]['id']));
    $storiesArray = $result->fetchAll(PDO::FETCH_ASSOC);
}
?>
<style>
    @media screen and (max-width: 1160px) {
        h2 {
            font-size:1em;
        }
        p {
            font-size:0.9em;
        }
    }
    p.red {
        
    }
</style>
<section>
    <article class="card" style=''>
        <div>
            <h2>Informations relatives au profil de <span style='color:rgb(186,0,0)'><?php echo $_GET['u_n']; ?></span></h2><hr>
            <div style='display:inline-flex; margin:0px;padding:0px;'>
                <!-- <?php
                $img = (file_exists($path = "images/users/".$userArray[0]['id'].".png"))?$path:'images/addPic.png';
                echo "<img alt='Image de profil' src='".$img."' style='border-radius:100px;margin:10px 0px 0px 0px;' width=70 height=70>";
                ?> -->
                <div style="padding:0px">
                    <ul class="spacedLi" style='list-style:none;padding-left:20px'>
                        <?php 
                        echo "<li><p class='red' style='margin-right:5px;'>Nom d'utilisateur :</p><p>".$userArray[0]['username']."</p></li>";
                        ?>
                        <li>
                            <p class='red' style='margin-right:0px;'>Prenom :</p>
                            <?php echo "<p>".$userArray[0]['firstname']."</p>"; ?>
                        </li>
                        <li>
                            <p class='red' style='margin-right:0px;'>Nom :</p>
                            <?php echo "<p>".$userArray[0]['lastname']."</p>"; ?>
                        </li>
                        <?php
                        $userArray[0]["joinedon"] = date($dateFormat, strtotime($userArray[0]["joinedon"]));
                        echo "<li><p class='red' style='margin-right:5px;'>Date d'inscription :</p><p> ".$userArray[0]['joinedon']."</p></li>";
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </article>
    <article class="card">
        <div>
            <h2>Les créations de <span style='color:rgb(186,0,0)'><?php echo $_GET['u_n']; ?></span></h2><hr>
            <?php
            if (count($storiesArray)) {
                for ($i=0; $i<count($storiesArray); $i++) {
                    $story = $storiesArray[$i];
                    $story["FormalDate"] = date($dateFormat, strtotime($story["publishedon"])); ?>
                    <div class='searchStoryElemt' style='padding:0px;font-style:italic;'>
                        <h2 style='margin:0px;font-size:17px;;font-style:normal'><a href="<?php echo "read.php?id=".$story["id"]; ?>"><?php echo $story["title"] ?></a></h2>
                        <?php echo $story["description"] ?>
                        <p style="margin:0px;color:rgba(0, 0, 0, 0.33);font-size:11px;font-style:normal"><?php echo "Publiée le ".$story["FormalDate"]." - <strong>".$story["likes"]." Likes</strong>" ?></p>
                        <?php
                        if (!($i == count($storiesArray)-1)) { ?><hr style='color:rgba(230, 230, 230, 0.207)'><?php }} ?>
                    </div>
            <?php
            } else {
                echo "<p>Cette utilsateur n'a pas encore créé ou publié d'histoires !</p>";
            }
            ?>
        </div>
    </article>
</section>
<?php include("footer.php"); ?>