<?php
$menu["title"] = "Lecture";
include("main_header.php");

$isLoggedIn = isset($_SESSION['user_id'])?$_SESSION['user_id']:0;

if (empty($_GET)) {
    header("location: search.php");
} else {
    $query = "SELECT title, story.likes, user.username, description, publishedon  
        FROM story, user WHERE story.user_id = user.id AND published = 1 AND story.id = ?";
    $result = $pdo->prepare($query);
    $result->execute(array($_GET["id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
}

if (!empty($row) && count($row[0])>0) {
    $story = $row[0];
    $story["FormalDate"] = date($dateFormat, strtotime($story["publishedon"]));
    $id_story = $_GET["id"];

    if ($isLoggedIn) {
        $query = "SELECT * FROM story_like WHERE id_user = ? AND id_story = ? AND val = 1 ;";
        $result = $pdo->prepare($query);
        $result->execute(array($_SESSION['user_id'], $_GET["id"]));
        $row = $result->fetchAll();
        $isLiked = (!empty($row))?1:0;
    } else {
        $isLiked = 0;
    }
    ?>
    <style>
        .linkAccount {
            text-decoration:none;
            margin:0px;
            color:rgba(0, 0, 0, 0.53);
            font-size:11px;
            font-style:normal
        }
        .linkAccount:hover {
            text-decoration:underline;
        }
        section {
            margin-right:60px;
        }
        article p.alert {
            font-size: 0.87em;
            margin-bottom: 5px;
        }
        aside.storyParam div {
            cursor: pointer;
        }
        aside p.alert {
            font-size: 0.80em;
            margin-bottom: 5px;
        }
        aside.storyParam hr{
            margin:5px 0px 10px 0px;
        }
        @media screen and (max-width: 1160px) {
            section {
                margin-right:0px;
            }
            article.storyParam {
                display:block;
            }
        }
    </style>
    <section>
        <script>
            var storyId = "<?php echo $id_story; ?>";
            var userId = "<?php echo $isLoggedIn ?>";
            var isLiked = "<?php echo $isLiked ?>";
        </script>
        <article class='card storyParam'>
            <div>
                <div>
                    <div class='likeStoryDiv'>
                        <?php echo "<img alt='Aimer cette histoire' src='images/".($isLiked?'liked.png':'like.png')."' width=45 class='likeStoryImg'>"; ?>
                        <p class='alert likeStoryText' style='margin-top:-3px'>Aimer cette histoire</p>
                    </div>
                </div>
                <hr>
                <div>
                    <div class='loadProgressDiv'>
                        <img alt='Charger la dernière progression' src="images/loadProgress.png" style='border-radius:12px;' width=40>
                        <p class='alert' style='margin-top:2px'>Charger la progression</p>
                    </div>
                </div>
            </div>
        </article>
        <article class="card" style=''>
            <div>
                <h1 style="text-align:center; font-size:2em"><?php echo $story["title"] ?></h1>
                <p style="margin-top:0px;color:grey;font-size:11px; text-align:center;">
                    <?php echo " - Publiée par <strong><a class='linkAccount' href='view_profile.php?u_n=".$story["username"]."'>".$story["username"]."</a></strong> le ".
                    $story["FormalDate"]." - <strong>Likes : ".$story["likes"]."</strong> - " ?></p><hr>
                <p><?php echo $story["description"] ?></p>
                <button id="read">Démarrer la lecture</button>
            </div>
        </article>
        <div id='storyContent'>
            
        </div>
        <article class='card storyParam'>
            <div>
                <div>
                    <div class='startOverDiv'>
                        <img alt='Recommencer' src="images/startOver.png" style='border-radius:10px; margin-top:10px' width=40>
                        <p class='alert' style='margin-top:0px'>Recommencer</p>
                    </div>
                    <div class='saveProgressDiv'>
                        <img alt='Sauver la progression' style='margin-top:10px' src="images/saveActive.png" width=35 class="saveStoryPath">
                        <p class='alert'>Sauver progression</p>
                    </div>
                </div>
            </div>
        </article>
    </section>
    <aside class='storyParam' style='bottom:auto; text-align:center'>
        <div style='margin-top:20px;' class='startOverDiv'>
            <img alt='Recommencer' src="images/startOver.png" style='border-radius:10px; margin-top:0px' width=40>
            <p class='alert' style='margin-top:0px'>Recommencer</p>
        </div><hr>
        <div class='saveProgressDiv'>
            <img alt='Sauver la progression' style='margin-top:10px' src="images/saveActive.png" width=35>
            <p class='alert'>Sauver progression</p>
        </div><hr>
        <div class='loadProgressDiv'>
            <img alt='Charger la dernière progression' src="images/loadProgress.png" style='border-radius:12px;' width=40>
            <p class='alert' style='margin-top:2px'>Charger la progression</p>
        </div><hr>
        <div class='likeStoryDiv'>
            <?php echo "<img alt='Aimer cette histoire' src='images/".($isLiked?'liked.png':'like.png')."' width=45 class='likeStoryImg'>"; ?>
            <p class='alert likeStoryText' style='margin-top:-3px'>Aimer cette histoire</p>
        </div>
    </aside>
<?php } else {
    header('location: search.php');
}
include('footer.php')
?>