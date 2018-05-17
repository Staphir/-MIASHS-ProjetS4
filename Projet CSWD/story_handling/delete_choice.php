<?php
include('../user_handling/config.php');

$id_story_choosed = $_POST["id_story"];
$id_element = $_POST["id"];

$query_steps="SELECT * FROM step WHERE id_story = ? ORDER BY step.id";
$response_steps=$pdo->prepare($query_steps);
$response_steps->execute(array($id_story_choosed));
$table_steps = $response_steps->fetchall(PDO::FETCH_ASSOC);

$query_choices="SELECT * FROM choice WHERE id_story = ? ORDER BY choice.id_step";
$response_choices=$pdo->prepare($query_choices);
$response_choices->execute(array($id_story_choosed));
$table_choices = $response_choices->fetchall(PDO::FETCH_ASSOC);

class Choice {
    //proprietes
    public $id = -1;
    public $parent = "";
    public $visited = 0;

    //methods
    function __construct($id, $parent)
    {
        $this->id = $id;
        $this->parent = $parent;
    }
}
class Step {
    //proprietes
    public $id = -1;
    public $parent = "";
    public $visited = 0;

    //methods
    function __construct($id, $parent)
    {
        $this->id = $id;
        $this->parent = $parent;
    }
}
//-----------------------------------------------------------------------
$choicesList = array();
$stepsList = array();
//remplissage listes choices et steps
array_push($stepsList, new Step($table_steps[0]["id"], $table_steps[0]["id_choice"]));
array_splice($table_steps,0,1);
//remplissage choicesList et stepsList
while(count($table_choices) != 0 || count($table_steps) != 0){
    $listToDel = array();
    for($i=0; $i<count($table_choices); $i++){
        for($j=0; $j<count($stepsList); $j++){
            if($stepsList[$j]->id == $table_choices[$i]["id_step"]){
                array_push($choicesList, new Choice($table_choices[$i]["id"], $stepsList[$j]));
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
                array_push($stepsList, new Step($table_steps[$i]["id"], $choicesList[$j]));
                array_push($listToDel, key($table_steps[$i]));
                break ;
            }
        }
    }
    $table_steps = array_diff_key($table_steps, $listToDel);
    $table_steps = array_values($table_steps);
}

$aSupp = array();
for($i=0; $i<count($choicesList); $i++){
    if($choicesList[$i]->id == $id_element){
        array_push($aSupp, $choicesList[$i]);
        break;
    }
}

function dfs($finalList, $choicesList, $stepsList, $node) {
    $node->visited = 1;
    for($i=0; $i<count($finalList); $i++){
        if($node->parent == $finalList[$i]){
            array_push($finalList, $node);
            break;
        }
    }
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

$aSupp = dfs($aSupp, $choicesList, $stepsList, $stepsList[0] );

for ($i=0; $i<count($aSupp); $i++){
    if(is_a($aSupp[$i], "Step")){
        $queryDel="DELETE FROM step WHERE id = ?";
        $responseDel=$pdo->prepare($queryDel);
        $responseDel->execute(array($aSupp[$i]->id));
    }else{
        $queryDel="DELETE FROM choice WHERE id = ?";
        $responseDel=$pdo->prepare($queryDel);
        $responseDel->execute(array($aSupp[$i]->id));
    }
}
?>
