<?php
$menu["title"] = "Rechercher";
include("main_header.php");

if (isset($_GET) && !empty($_GET) && isset($_GET["search"])) {
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Core.Encoding', 'ISO-8859-1');
    $config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
    $config->set('HTML.Allowed', '');
    
    $purifier = new HTMLPurifier($config);
    $search = $purifier->purify($_GET["search"]);
} else {
    $search = '';
}

$query = "SELECT title, story.likes, username, story.id, description, publishedon FROM story INNER JOIN user ON story.user_id = user.id WHERE title like '%".$search."%' AND published = 1 ORDER BY `story`.`likes` DESC LIMIT 20";
$result = $pdo->prepare($query);
$result->execute(array($search));
$row = $result->fetchAll(PDO::FETCH_ASSOC);

$search_value = '²'
?>
<div class="search">
    <div>
        <h2 style='font-size:15px;padding:0px'>Résultats de la recherche pour :</h2>
        <?php echo ($search=='')?'Toutes les histoires':$search; ?>
    </div>
</div>
<aside class='searchAttr' style='text-align:justify;'>
    <h2 style='margin:10px 0px;'>Recherche avancée</h2><hr>
    <p>Ici prochainement, un utilitaire de recherche par tags et catégories !</p>
</aside>
<section id='searchResults'>
    <article id='floatingSearchBar' class="card">
        <form method='get'>
            <div style='padding:0px;margin-right10px;display:flex;'>
                <input type='text' name='search' <?php echo ($search=='')?"value='Toutes les histoires...'":"value='$search'"; ?> placeholder='Rechercher un titre...' style='font-size:1.1em;margin-right:10px;border:none'>
                <input type='submit' value='Rechercher' style='width:auto; margin-right:10px;'>
            </div>
        </form>
    </article>
    <?php
    if (!empty($row) && count($row[0])>0) {
    ?>
    <style>
        .linkAccount {
            text-decoration:none;
            margin:0px;
            color:rgba(0, 0, 0, 0.33);
            font-size:11px;
            font-style:normal
        }
        .linkAccount:hover {
            text-decoration:underline;
        }
    </style>
    <article class="card">
        <div style='padding:20px;'>
        <?php
        for ($i=0; $i<count($row); $i++) {
            $story = $row[$i];
            $story["FormalDate"] = date($dateFormat, strtotime($story["publishedon"])); ?>
            <div class='searchStoryElemt' style='padding:0px;font-style:italic;'>
                <h2 style='margin:0px;font-size:17px;;font-style:normal'><a href="<?php echo "read.php?id=".$story["id"]; ?>"><?php echo $story["title"] ?></a></h2>
                    <?php echo $story["description"] ?>
                <p style="margin:0px;color:rgba(0, 0, 0, 0.33);font-size:11px;font-style:normal"><?php echo "Publiée par <strong><a class='linkAccount' href='view_profile.php?u_n=".$story["username"]."'>".$story["username"]."</a></strong> le ".$story["FormalDate"]." - <strong>".$story["likes"]." Likes</strong>" ?></p>
            <?php
            if (!($i == count($row)-1)) { ?><hr style='color:rgba(230, 230, 230, 0.207)'><?php } ?>
            </div>
        <?php } ?>
        </div>
    </article>
    <?php } else { ?>
    <article class="card">
        <div>
            <h2>Aucun résultat...</h2><hr>
            <p>La recherche n'a retourné aucun résultat !</p>
        </div>
    </article>
    <?php } ?>
</section>
<?php
include("footer.php");
?>