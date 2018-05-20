<?php
include('../user_handling/config.php');
include('../vendor/autoload.php');

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', $HTMLAllowed_Title);
$purifier = new HTMLPurifier($config);

$title = $purifier->purify($_POST['title']);

$query = "UPDATE story SET title = ?, lastmodifiedon = NOW() WHERE id = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($title, $_POST["id"]));
echo $title;
?>
