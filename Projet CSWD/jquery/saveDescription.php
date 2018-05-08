<?php
include('../user_handling/config.php');
include('../vendor/autoload.php');

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', $HTMLAllowed_Description);
$purifier = new HTMLPurifier($config);

$description = $purifier->purify($_POST['description']);

$query = "UPDATE story SET description = ?, lastmodifiedon = NOW() WHERE id = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($description, $_POST["id"]));
echo $description;
?>
