<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");


if(!isset($_POST["id_story"]) or empty($_POST["id_story"])) {
    if (!isset($_SESSION["id_story"]) or $_SESSION["id_story"] == null) {
        header("location: my_stories.php");
    }else{
        $id_story_choosed = $_SESSION['id_story'];
    }
} else {
    $id_story_choosed = $_POST['id_story'];
    $_SESSION['id_story'] = $id_story_choosed;
}



$query="SELECT * FROM story WHERE story.id = ? AND user_id = ? ";
$result=$pdo->prepare($query);
$result->execute(array($id_story_choosed, $_SESSION["user_id"]));
$row = $result->fetchall(PDO::FETCH_ASSOC);

if (empty($row)) {
    header("location: my_stories.php");
} else {
    $query_first_step="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id = ? AND step.id_choice = 0 ";
    $response_first_step=$pdo->prepare($query_first_step);
    $response_first_step->execute(array($id_story_choosed));
    $first_step = $response_first_step->fetchall(PDO::FETCH_ASSOC);
    ?>
    <style>
        section {
            margin-right:60px;
        }
        article.storyParam {
            display:none;
            background-color:transparent;
            box-shadow:none;
            margin-top:0px;
            box-sizing: border-box;
        }
        article.storyParam div {
            display:flex;
            flex:1;
            padding:0px;
            /* border-radius:20px; */
            background-color:white;
            box-shadow:1px 1px 7px 0px rgba(0, 0, 0, 0.24);
        }
        article.storyParam div div {
            vertical-align:middle;
            box-shadow:none;
        }

        article.storyParam div div div {
            display:block;
            text-align:center;
            overflow:hidden;
            margin: 0px;
            box-shadow:none;
        }
        article.storyParam div div div img {
            margin-top:10px;
        }

        article.storyParam div div p {
            margin:10px 0px;
        }
        article.storyParam div hr {
            margin:0px;
            border:none;
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
        <script>var storyId = <?php echo $row[0]["id"]; ?>; </script>
        <script>var user_id = <?php echo $row[0]["id"]; ?>; </script>
        <article class='card storyParam'>
            <div>
                <div>
                    <div>
                        <div>
                            <label class="switch" style='margin-top:20px;width:60px;height:34px;'>
                                <input type="checkbox" <?php echo ($row[0]['published'])?'checked':''; ?> class='publishCheckbox'>
                                <span class="slider round"></span>
                            </label>
                            <p class='alert publishText'><?php echo ($row[0]['published'])?'Publiée':'Publier'; ?></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div>
                        <div>
                            <img alt='Supprimer' style='margin-top:12px' src="../images/trash.png" width=35 class="deleteStory">
                            <p class='alert'>Supprimer</p>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <div>
                        <a href='../rules.php#formatage' target='_blank' style=''>
                            <img alt='Règles HTML' src="../images/html.png" style='border-radius:12px;' width=60>
                        </a>
                        <p class='alert' style='margin-top:-3px'>Règles HTML</p>
                    </div>
                </div>
            </div>
        </article>
        <article class="card">
            <div>
                <?php echo "<h2 style='text_align:center;'>".$row[0]["title"]."</h2>"; ?><hr>
                <fieldset style='padding:0px; border-radius:5px; border:1px solid black;margin-top:20px'>
                    <legend style='margin-left:20px;'>Description <img id='editDescImg' alt='Edit' src='../images/edit.png' width=17>
                        <img id='saveDesc' src='../images/save.png' alt='save' width=15></legend>
                    <div style='margin:10px; padding:0px;'>
                        <style>
                            #textAreaDesc {
                                resize: vertical;
                                width: 100%;
                                height: 100%;
                                box-sizing: border-box;
                                border: medium none;
                                display: none;
                            }
                            </style>
                            <div style='padding:0px;margin:0px;'>
                                <textarea id="textAreaDesc" placeholder="..." name="stream"><?php echo $row[0]["description"]; ?></textarea>
                                <div id='container' style='padding:0px;margin:0px;'>
                                    <?php echo $row[0]["description"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <?php
                if($first_step == NULL){
                    ?>
                    <form action="create_step.php" method="post">
                        <input type="hidden" name="id_story" value="<?php echo $id_story_choosed ?>">
                        <input type="hidden" name="parent" value="0">
                        <input type="hidden" id="step_or_choice" name="step_or_choice" value="Step">
                        <input type="hidden" name="id" value="0">
                        <input type="submit" name="new_step" style='width:auto;margin-top:10px;' value="Démarrer l'écriture">
                    </form>
                <?php }else{
                    $query_steps="SELECT * FROM step WHERE id_story = ? ORDER BY step.id";
                    $response_steps=$pdo->prepare($query_steps);
                    $response_steps->execute(array($id_story_choosed));
                    $table_steps = $response_steps->fetchall(PDO::FETCH_ASSOC);

                    $query_choices="SELECT * FROM choice WHERE id_story = ? ORDER BY choice.id_step";
                    $response_choices=$pdo->prepare($query_choices);
                    $response_choices->execute(array($id_story_choosed));
                    $table_choices = $response_choices->fetchall(PDO::FETCH_ASSOC);

                    $id_story = $table_steps[0]["id_story"];
                    //------------------------------------------------------------
                    class Choice {
                        //proprietes
                        public $id = -1;
                        public $content = "";
                        public $parent = "";
                        public $deep = 0;
                        public $visited = 0;

                        //methods
                        function __construct($id, $content, $parent, $deep)
                        {
                            $this->id = $id;
                            $this->content = $content;
                            $this->parent = $parent;
                            $this->deep = $deep;
                        }
                    }
                    class Step {
                        //proprietes
                        public $id = -1;
                        public $content = "";
                        public $parent = "";
                        public $deep = 0;
                        public $visited = 0;

                        //methods
                        function __construct($id, $content, $parent, $deep)
                        {
                            $this->id = $id;
                            $this->content = $content;
                            $this->parent = $parent;
                            $this->deep = $deep;
                        }
                    }
                    $finalList = array();
                    $choicesList = array();
                    $stepsList = array();
                    //remplissage listes choices et steps
                    array_push($stepsList, new Step($table_steps[0]["id"], $table_steps[0]["content"], $table_steps[0]["id_choice"], 0));
                    array_splice($table_steps,0,1);
                    //remplissage choicesList et stepsList
                    while(count($table_choices) != 0 || count($table_steps) != 0){
                        $listToDel = array();
                        for($i=0; $i<count($table_choices); $i++){
                            for($j=0; $j<count($stepsList); $j++){
                                if($stepsList[$j]->id == $table_choices[$i]["id_step"]){
                                    array_push($choicesList, new Choice($table_choices[$i]["id"], $table_choices[$i]["content"], $stepsList[$j], $stepsList[$j]->deep+1));
                                    array_push($listToDel, key($table_choices[$i]));
                                    break ;
                                }
                            }
                        }
                        $table_choices = array_diff_key($table_choices, $listToDel);
                        $table_choices = array_values($table_choices);
                        $listToDel = array();
                        for($i=0; $i<count($table_steps); $i++){
                            for($j=0; $j<count($choicesList); $j++){
                                if($choicesList[$j]->id == $table_steps[$i]["id_choice"]){
                                    array_push($stepsList, new Step($table_steps[$i]["id"], $table_steps[$i]["content"], $choicesList[$j], $choicesList[$j]->deep+1));
                                    array_push($listToDel, key($table_steps[$i]));
                                    break ;
                                }
                            }
                        }
                        $table_steps = array_diff_key($table_steps, $listToDel);
                        $table_steps = array_values($table_steps);
                    }
                    //remplissage finalList
                    function dfs($finalList, $choicesList, $stepsList, $node) {
                        $node->visited = 1;
                        array_push($finalList, $node);
                        if(is_a($node, "Step")){
                            for($i=0; $i<count($choicesList); $i++){
                                if($choicesList[$i]->parent == $node && $choicesList[$i]->visited == 0){
                                    $finalList = dfs($finalList, $choicesList, $stepsList, $choicesList[$i]);
                                }
                            }
                        }else{
                            for($i=0; $i<count($stepsList); $i++){
                                if($stepsList[$i]->parent == $node && $stepsList[$i]->visited == 0){
                                    $finalList = dfs($finalList, $choicesList, $stepsList, $stepsList[$i]);
                                }
                            }
                        }
                        return $finalList;
                    }
                    $finalList = dfs($finalList, $choicesList, $stepsList, $stepsList[0]);

                    $id_parents_list = array();
                    $step_or_choice = array();
                    $id_list = array();
                    $id_parents_list[0] = 0;
                    $step_or_choice[0] = "Step";
                    $id_list[0] = $finalList[0]->id;
                    for($i=1; $i<count($finalList); $i++){
                        array_push($id_parents_list, $finalList[$i]->parent->id);
                        array_push($step_or_choice, get_class($finalList[$i]));
                        array_push($id_list, $finalList[$i]->id);
                    }
                    echo "<div><textarea id='treeEntry' >";
                    for($i=0;$i<count($finalList);$i++){
                        for($j=0;$j<$finalList[$i]->deep;$j++){
                            echo " ";
                        }
                        echo $finalList[$i]->content."\n";
                    }
                    echo "</textarea></div>";

                    //------------------------------------------------------------
                }
                ?>
                <?php
                include("../scripts_tree/tree_style.php");
                ?>


                </div>
            </article>
        </section>
        <aside class='storyParam' style='bottom:auto; text-align:center'>
            <div style='margin-top:20px;'>
                <label class="switch">
                    <?php echo $row[0]['published'] ;?>
                    <input type="checkbox" <?php echo ($row[0]['published'])?'checked':''; ?> class='publishCheckbox'>
                    <span class="slider round"></span>
                </label>
                <p class='alert publishText' style='font-size:1.4em;padding:0px;margin:0px;'><?php echo ($row[0]['published'])?'Publiée':'Publier'; ?></p>
            </div><hr>
            <div>
                <img alt='Supprimer' src="../images/trash.png" width=40 class="deleteStory" onmouseover="this.src='../images/trash_hover.png'" onmouseout="this.src='../images/trash.png'" onmousedown="this.src='../images/trash_down.png'">
                <p class='alert' style='font-size:1.2em;padding:0px;margin:10px 0px;'>Supprimer</p>
            </div><hr>
            <div>
                <a href='../rules.php#formatage' target='_blank' style='margin:0px;padding:0px;'>
                    <img alt='Règles HTML' src="../images/html.png" style='border-radius:12px;' width=70 onmouseover="this.src='../images/html_hover.png'" onmouseout="this.src='../images/html.png'" onmousedown="this.src='../images/html_down.png'">
                </a>
                <p class='alert' style='font-size:1em;padding:0px;margin:0px'>Règles HTML</p>
            </div>
        </article>
    </section>
    <aside class='storyParam' style='bottom:auto; text-align:center'>
        <div style='margin-top:20px;'>
            <label class="switch">
                <input type="checkbox" <?php echo ($row[0]['published'])?'checked':''; ?> id='publishedCheckbox'>
                <span class="slider round"></span>
            </label>
            <p class='alert' id='publishText' style='font-size:1.4em;padding:0px;margin:0px;'><?php echo ($row[0]['published'])?'Publiée':'Publier'; ?></p>
        </div><hr>
        <div>
            <img alt='Supprimer' src="../images/trash.png" width=40 id="deleteStory" onmouseover="this.src='../images/trash_hover.png'" onmouseout="this.src='../images/trash.png'" onmousedown="this.src='../images/trash_down.png'">
            <p class='alert' style='font-size:1.2em;padding:0px;margin:10px 0px;'>Supprimer</p>
        </div><hr>
        <div>
            <a href='../rules.php#formatage' target='_blank' style='margin:0px;padding:0px;'>
                <img alt='Règles HTML' src="../images/html.png" style='border-radius:12px;' width=70 onmouseover="this.src='../images/html_hover.png'" onmouseout="this.src='../images/html.png'" onmousedown="this.src='../images/html_down.png'">
            </a>
            <p class='alert' style='font-size:1em;padding:0px;margin:0px'>Règles HTML</p>
        </div>
    </aside>

    <form method="post" action="create_step.php" id="infos_click">
        <input type="hidden" name="id_story" value="<?php echo $id_story_choosed; ?>">
        <input type="hidden" id="parent" name="parent" value="0">
        <input type="hidden" id="step_or_choice" name="step_or_choice" value="Step">
        <input type="hidden" id= "id" name="id" value="<?php echo $first_step[0]["id"] ?>">
    </form>
    <script type="text/javascript">
        var id_parents = <?php echo json_encode($id_parents_list); ?>;
        var type = <?php echo json_encode($step_or_choice); ?>;
        var id_element = <?php echo json_encode($id_list); ?>;
        var choices = <?php echo json_encode($choicesList); ?>;
        var steps = <?php echo json_encode($stepsList); ?>;
    </script>
    <script src="script.js"></script>
    <script src="../scripts_tree/treetodiagram.js"></script>
    <script src="../scripts_tree/layoutText.js"></script>
    <script src="../scripts_tree/gup.js"></script>
    <script src="../scripts_tree/texttotree.js"></script>
    <script src="../scripts_tree/demo.js"></script>
    <?php

    include("../footer.php");
}
?>
