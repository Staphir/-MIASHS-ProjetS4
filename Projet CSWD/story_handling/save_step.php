<?php require_once("../user_handling/config.php");

//Probleme quand il y a des "entrer" dans le textarea
$step = htmlspecialchars($_POST["step"], ENT_QUOTES);
$is_story = $_POST["id_story"];
$choice_parent = $_POST["choice_parent"];
$nb_choice = $_POST["nb_choix"];
$tab_choices = array();
for($i=1; $i<=$nb_choice; $i++){
    if (isset($_POST["choix".$i])){
        array_push($tab_choices, $_POST["choix".$i]);
        echo "boucle 1 : ".$i."\n";
    }
}
$query_step = "INSERT INTO step (content, id_choice, id_story) VALUES (?,?,?);";
$reponse_step = $pdo->prepare($query_step);
$reponse_step->execute(array($step, $choice_parent, $is_story));

$query = "SELECT id FROM step WHERE content = ?";
$response = $pdo->prepare($query);
$response->execute(array($step));
$id_step = $response->fetch(PDO::FETCH_ASSOC);
echo $step."\n";

for($i=0; $i<count($tab_choices); $i++) {
    $query_choice = "INSERT INTO choice (content, id_step, id_story) VALUES (?,?,?);";
    $reponse_choice = $pdo->prepare($query_choice);
    $reponse_choice->execute(array($tab_choices[$i], $id_step["id"], $is_story));
    echo "boucle 2 : ".$i."\n";
}

header("location: story_display.php?story_id=".$is_story);
?>
