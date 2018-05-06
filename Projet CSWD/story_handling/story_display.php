<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");

$menu["title"] = "Mes histoires";
$dir1 = "../"; $dir2 = "../";
include("../main_header.php");

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', $HTMLAllowed_Description);
$purifier = new HTMLPurifier($config);

if(!isset($_POST["story_id"]) or empty($_POST["story_id"])) {
    header("location: my_stories.php");
} else {
    $id_story_choosed = $_POST['story_id'];

    if (!empty($_POST['bkpDesc'])) { // Les infos sur la description sont présentes
        if (!empty($_POST['stream'])) { // On prend en priorité le code dans l'input visible
            $description = $purifier->purify($_POST['stream']);
        } else {
            $description = $purifier->purify($_POST['bkpDesc']);
        }
        $query = "UPDATE story SET description = ? WHERE id = ? ;";
        $result = $pdo->prepare($query);
        $result->execute(array($description, $_POST["story_id"]));
    }


//Affichage direct après enregistrement step qui ne fonctionne pas...
//test si variable de session (si on est passé par une création de step
//ou si on vient juste du choix des histoires on a seulement un post et en session j'ai mis à null
//if(!isset($_POST["story_id"]) or empty($_POST["story_id"]) and $_SESSION["story_id"] == null) {
if(!isset($_POST["id_story"]) or empty($_POST["id_story"])){
    if((!isset($_SESSION["id_story"]) or $_SESSION["id_story"] == null)){
        header("location: my_stories.php");
    }
} else {
    if(!isset($_POST["id_story"]) or empty($_POST["id_story"])){
        echo "SESSION";
        $id_story_choosed = $_SESSION["id_story"];
    }else{
        $id_story_choosed = $_POST['id_story'];
    }
//    echo $id_story_choosed;
    $query="SELECT * FROM story WHERE story.id = ? AND user_id = ? ";
    $result=$pdo->prepare($query);
    $result->execute(array($id_story_choosed, $_SESSION["user_id"]));
    $row = $result->fetchall(PDO::FETCH_ASSOC);

    if (empty($row)) {
        header("location: my_stories.php");
    } else {
//        echo "WHAT !!!!";
        $query_first_step="SELECT * FROM step LEFT JOIN story ON step.id_story = story.id WHERE story.id = ? AND step.id_choice = 0 ";
        $response_first_step=$pdo->prepare($query_first_step);
        $response_first_step->execute(array($id_story_choosed));
        $first_step = $response_first_step->fetchall(PDO::FETCH_ASSOC);
        ?>
        <section>
            <article class="card">
                <div>
                    <?php echo "<h2 style='text_align:center;'>".$row[0]["title"]."</h2><hr>"; ?>
                    <form method='post'>
                        <?php 
                        echo "<input type='hidden' name='story_id' value=".$_POST["story_id"].">"; 
                        echo "<input type='hidden' name='bkpDesc' value='' id='hiddenDesc'>";
                        ?>
                        <fieldset style='padding:0px; border-radius:5px; border:1px solid black;'>
                                <legend style='margin-left:10px;'>Description <img id='editImg' alt='Edit' src='../images/edit.png' width=17 onclick="modifyDescription();getDesc();" >
                                <input type='image' src='../images/save.png' width=15 onmouseout="this.src='../images/save.png'" onmouseover="this.src='../images/saveActive.png'"></legend>
                                <div style='margin:10px; padding:0px;'><div id='descriptionContainer' style='padding:0px; margin:0px;'>
                                    <?php echo $row[0]["description"]; ?>
                                </div></div>
                                
                        </fieldset>
                    </form>
                    <div style='font-size:0.60em; margin:5px; padding:0px;'>
                    <p style='margin:0px;'>
                        Storystoire prend en charge le code HTML pour la mise en forme des textes ! 
                        <a style='margin:0px; color:grey' target="_blank" href='../rules.php?#formatage' >Voir les règles d'écriture et de formatage d'histoire</a>
                    </p>
                    <div>
                    <?php 
                    if($first_step == NULL){
                        ?>
                        <form action="create_step.php" method="post">
                            <input type="hidden" name="id_story" value="<?php echo $id_story_choosed ?>">
                            <input type="hidden" name="parent" value="0">
                            <input type="submit" name="new_step" value="Nouvelle étape">
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
                    $id_parents_list[0] = 0;
                    $step_or_choice[0] = "Step";
                    for($i=1; $i<count($finalList); $i++){
                        array_push($id_parents_list, $finalList[$i]->parent->id);
                        array_push($step_or_choice, get_class($finalList[$i]));
                    }
                    ?>

                        <script type="text/javascript">
                            var id_parents = <?php echo json_encode($id_parents_list); ?>;
                            var type = <?php echo json_encode($step_or_choice); ?>;
                        </script>

                        <?php
                        echo "<textarea id='treeEntry' hidden>";
//                        echo $id_story."%0%".$finalList[0]->content;
                        for($i=0;$i<count($finalList);$i++){
//                            echo "\n".$id_story."%".$finalList[$i]->parent->id."%";
                            for($j=0;$j<$finalList[$i]->deep;$j++){
                                echo " ";
                            }
                            echo $finalList[$i]->content."\n";
                        }
                        echo "</textarea>";

                        //------------------------------------------------------------
                    }
                    ?>
                    <?php
                    include("../scripts_tree/tree_style.php");
                    ?>
                </div>
            </article>
        </section>
        <form method="post" action="create_step.php" id="infos_click">
            <input type="hidden" name="id_story" value="<?php echo $id_story_choosed; ?>">
            <input type="hidden" id="parent" name="parent" value="0">
            <input type="hidden" id="step_or_choice" name="step_or_choice" value="Step">
        </form>
        <script src="script.js"></script>
        <script src="../scripts_tree/treetodiagram.js"></script>
        <script src="../scripts_tree/layoutText.js"></script>
        <script src="../scripts_tree/gup.js"></script>
        <script src="../scripts_tree/texttotree.js"></script>
        <script src="../scripts_tree/demo.js"></script>
        <?php

        include("../footer.php");
    }
}
?>
