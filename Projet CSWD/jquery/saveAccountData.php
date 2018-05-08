<?php
include('../user_handling/config.php');
include('../vendor/autoload.php');

$config = HTMLPurifier_Config::createDefault();
$config->set('Core.Encoding', 'ISO-8859-1');
$config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
$config->set('HTML.Allowed', '');
$purifier = new HTMLPurifier($config);

$firstname = $purifier->purify($_POST['firstname']);
$lastname = $purifier->purify($_POST['lastname']);

$query = "UPDATE user SET firstname = '$firstname', lastname = '$lastname' WHERE id = ? ;";
$result = $pdo->prepare($query);
$result->execute(array($_POST["id"]));
echo json_encode(array($firstname, $lastname));
?>
