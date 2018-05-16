<?php
include('../user_handling/config.php');

if (!empty($_POST)) {
    $query = 'SELECT * FROM choice WHERE id = ? ;';
    $array = array($_POST['id_choice']);
    $result = $pdo->prepare($query);
    $result->execute($array);
    $row1 = $result->fetchAll(PDO::FETCH_ASSOC);
    // print_r($row1);

    if ($row1) {
        $query = "SELECT * FROM step WHERE id = ? ;";
        $array = array($row1[0]['id_step']);
        $result = $pdo->prepare($query);
        $result->execute($array);
        $row2 = $result->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $row2 = [];
    }
    $toEncode = array($row1, $row2);
    echo json_encode($toEncode);
} else {header('index.php');}


// Quand je clique sur démarrer, j'insertStep(0) ce qui signifie 
// requete avec l'id de l'histoire et parent = 0
// je recup * from step where id_story = (id de l'histoire) 
// et id_choice = (variable parent)
// Donc je recup une étape qui vient du choix 0 c'est à dire le début
// de l'histoire id_story
// Si ceci envoit une réponse alors je récupère les choix correspondants
// à l'id de l'étape récupérée avant

// Donc : je recup une étape a partir de son id de choix parent
// et a partir de cette étape je regarde dans la table choix 
// ceux qui ont le même id que la ligne que j'ai récupéré

// possède l'id du choix qui est présent dans la div


?>