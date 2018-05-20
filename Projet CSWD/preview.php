<?php
$menu["title"] = "Lecture";
include("main_header.php");

if (isset($_GET) && !empty($_GET['id']) && isset($_SESSION['user_id'])) {
    $query="SELECT * FROM story WHERE story.id = ? AND user_id = ? ";
    $result=$pdo->prepare($query);
    $result->execute(array($_GET['id'], $_SESSION["user_id"]));
    $row = $result->fetchall(PDO::FETCH_ASSOC);
    $story = $row[0];
} else {
    header('location: story_handling/my_stories.php');
}

if (count($row)>0) {
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
            var storyId = "<?php echo $story["id"]; ?>";
        </script>
        <article class="card" style=''>
            <div>
                <h1 style="text-align:center; font-size:2em"><?php echo $story["title"] ?></h1><hr>
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
                </div>
            </div>
        </article>
    </section>
    <aside class='storyParam' style='bottom:auto; text-align:center'>
        <div style='margin-top:20px;' class='startOverDiv'>
            <img alt='Recommencer' src="images/startOver.png" style='border-radius:10px; margin-top:0px' width=40>
            <p class='alert' style='margin-top:0px'>Recommencer</p>
        </div>
    </aside>
<?php } else {
    header('location: story_handling/my_stories.php');
}
include('footer.php')
?>