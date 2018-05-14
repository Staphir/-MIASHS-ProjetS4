<?php 
include("vendor/autoload.php");

if (!isset($dir1)) {
    $dir1 = "";
} 
if (!isset($dir2)) {
    $dir2 = "";
}
$full_header = false;
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
        <div id="maincontent">