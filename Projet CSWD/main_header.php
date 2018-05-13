<?php 
include("vendor/autoload.php");

if (!isset($dir1)) {
    $dir1 = "";
} 
if (!isset($dir2)) {
    $dir2 = "";
}

if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET["search"])) {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'ISO-8859-1');
        $config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
        $config->set('HTML.Allowed', '');
     
        $purifier = new HTMLPurifier($config);
        $search = $purifier->purify($_GET["search"]);
    }
}

$search_value = (!empty($search))?"value=".$search:"value=''";
$full_header = false;
//  in_array($menu["title"], array("Accueil", "À propos", "Contact", "Mon compte"));
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>
            Storystoire - <?php echo $menu["title"]; ?>
        </title>
        <link href=<?php echo $dir1."css/style.css" ?> rel="stylesheet" type="text/css" media="all"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">
        <link rel="shortcut icon" href=<?php echo $dir1."images/icon.png" ?>>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src=<?php echo $dir1."jquery/myJQueryFunctions.js"; ?>></script>
        <?php 
        require_once("user_handling/config.php");
        require_once("user_handling/session.php");
        ?>
    </head>
    <body>
        <div class='layer'></div>
        <div class='sideBar'><?php include('sidebar.php'); ?></div>
        <div class="top_header">
            <img width=40 height=40 src=<?php echo $dir1.'images/sideBarMenu.png'; ?> id='hamburger'>
            <h1 id='mainHeaderTitle' class="storystoire_header noselect">Storystoire</h1>
            <div class='topBar'><?php include('topbar.php'); ?></div>
        </div>
        <div id="maincontent" <?php echo ($full_header)?"style=margin-top:130px":"style=margin-top:70px"; ?> >