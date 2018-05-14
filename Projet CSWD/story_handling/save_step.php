<?php
require_once("../user_handling/config.php");
require_once("../user_handling/session.php");
include('../vendor/autoload.php');

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', $HTMLAllowed_Step);
$purifier = new HTMLPurifier($config);
// $ = $purifier->purify();

//Probleme quand il y a des "entrer" dans le textarea
//Tu sais d'où ça vient ?
$step = $purifier->purify($_POST["step"]);
$is_story = $_POST["id_story"];
$choice_parent = $_POST["parent"];
$choices_modified = $_SESSION['choices_modified'];
$nb_choice = $_POST["nb_choix"];
$new_step = $_POST["newStep"];
$_SESSION["id_story"] = $is_story;
$tab_choices = array();

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null);
$config->set('HTML.Allowed', $HTMLAllowed_Choice);
$purifier = new HTMLPurifier($config);
$nb_new_choice = $nb_choice - count($choices_modified);
for($i=0; $i<=$nb_choice; $i++){
    if (isset($_POST["choix".$i])){
        array_push($tab_choices, $purifier->purify($_POST["choix".$i]));
    }
}

//nouvelle etape ?
if($new_step == "yes"){
    //insertion nouvelle etape
    $query_step = "INSERT INTO step (content, id_choice, id_story) VALUES (?,?,?);";
    $reponse_step = $pdo->prepare($query_step);
    $reponse_step->execute(array($step, $choice_parent, $is_story));

    //recuperation id nouvelle etape
    $query = "SELECT id FROM step WHERE id_choice = ?";
    $response = $pdo->prepare($query);
    $response->execute(array($choice_parent));
    $id_step = $response->fetch(PDO::FETCH_ASSOC);

    //ajouts choix
    for($i=0; $i<count($tab_choices); $i++) {
        $query_choice = "INSERT INTO choice (content, id_step, id_story) VALUES (?,?,?);";
        $reponse_choice = $pdo->prepare($query_choice);
        $reponse_choice->execute(array($tab_choices[$i], $id_step["id"], $is_story));
    }
}else{

    //update etape
    $query_upstep = "UPDATE step SET content = ?, id_choice = ?, id_story = ? WHERE id = ?;";
    $reponse_upstep = $pdo->prepare($query_upstep);
    $reponse_upstep->execute(array($step, $choice_parent, $is_story, $_POST["stepId"]));

    //maj choix
    for ($i=0; $i<count($choices_modified); $i++){
        $query_upchoice = "UPDATE choice SET content = ? WHERE id = ?;";
        $reponse_upchoice = $pdo->prepare($query_upchoice);
        $reponse_upchoice->execute(array($tab_choices[$i], $choices_modified[$i]["id"]));
    }
    if (empty($choices_modified)){
        $j = 0;
    }else{
        $j = count($choices_modified);
    }
    //ajouts choix
    for($i=$j; $i<count($tab_choices); $i++) {

        $query_choice = "INSERT INTO choice (content, id_step, id_story) VALUES (?,?,?);";
        $reponse_choice = $pdo->prepare($query_choice);
        $reponse_choice->execute(array($tab_choices[$i], $_POST["stepId"], $is_story));
    }
}






header("location: story_display.php");
?>
