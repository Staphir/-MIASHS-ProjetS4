<?php 
$menu["title"] = "Mon compte";
include("main_header.php");
// include('tools/SimpleImage.php');
$isConnected = false;

if (!empty($_SESSION['user_id'])) {
    $query = "SELECT * FROM user WHERE id = ?";
    $result = $pdo->prepare($query);
    $result->execute(array($_SESSION["user_id"]));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    if (count($row)) {$isConnected = true;}
}

if (isset($_POST) && !empty($_FILES['fileUpload']['tmp_name']) && ($_FILES['fileUpload']['tmp_name'] != "")) {
    // print_r($_FILES);
    $target_dir = "uploads/tmp/";
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        $width = $check[0];
        $height = $check[1];
    } else {
        $res = 'Mauvais type de fichier !';
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $res = 'Déjà importé, veuillez patienter !';
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileUpload"]["size"] > 1000000) {
        $res = 'Le fichier est trop lourd !';
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $res = "Format d'image non pris en charge !";
        $uploadOk = 0;
    }

    $res = "Cette fonctionnalité n'est pas autorisée sur ce serveur, désolé !";

    // Check if $uploadOk is set to 0 by an error
    // if ($uploadOk) {
        // $res = 'Image importée !';
        // $factor = (10000/$width)/100;
        // $new_width = $width*$factor;
        // $new_height = $height*$factor;

        // rename($_FILES["fileUpload"]["tmp_name"], $new_target = $target_dir.$_SESSION['user_id']."_full.png");
        // ///
        // $target_dir = "images/users/";
        // $resize_target_file = $target_dir.$_SESSION['user_id'].".png";
    
        // $image = new SimpleImage();
        // $image->load($new_target);
        // $image->resize($new_width, $new_height);
        // $image->save($resize_target_file);
        // unlink($new_target);
        // ///
    // } else { 
    echo '<script>alert("'.$res.'");</script>';
    // }
}

if (!$isConnected) {
    header("location: user_handling/login.php");
} else { ?>

<style>
    input.firstname, input.lastname {
        width: auto;
        padding: 0px 3px;
        margin: 0px;
    }

    div#saveData {
        margin: 0px;
        padding: 0px;
    }

    div#saveData input {
        width: auto;
        margin: 0px 0px 10px 0px;
        padding: 10px;
    }

    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 80%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0} 
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    /* The Close Button */
    .close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 2px 16px;
        background-color: white;
        color: rgba(186, 0, 0);
    }

    .modal-body {padding: 2px 16px;}

    .modal-footer {
        padding: 2px 16px;
        background-color: white;
        color: black;
    }
</style>

<section>
    <article class="card">
        <div>
            <div style='display:inline-flex; margin:0px;padding:0px;'>
                <?php
                $img = (file_exists($path = "images/users/".$_SESSION['user_id'].".png"))?$path:'images/addPic.png';
                echo "<img id='AccountImgModalBtn' alt='Ajouter une image' src='".$img."' style='cursor:pointer;border-radius:100px;margin:10px 10px 0px 0px;' width=40 height=40>";
                ?>
                <h2 style='padding-top: 15px;margin-bottom: 0px;'>Mon compte</h2>
            </div>
            <hr>
            <p>Vous trouverez ici les informations liées à votre compte</p>
            
            <div style="padding-top:0px"><ul class="spacedLi">
                <?php 
                $img = "<a href=><img src=></a>";
                echo "<li><p class='red'>Nom d'utilisateur : </p><p>".$row[0]['username']."</p></li>";
                echo "<li><p class='red'>Adresse email : </p><p>".$row[0]['email']."</p></li>";
                ?>
                <li>
                    <p class='red'>Prenom : </p>
                    <img id='firstnameImg' alt='Edit' src='images/edit.png' width=17>
                    <?php 
                    echo "<p class='firstname'>".$row[0]['firstname']."</p>";
                    echo "<input class='firstname' value='".$row[0]['firstname']."' placeholder='...' type='text' style='display:none;'>";
                    ?>
                </li>
                <li>
                    <p class='red'>Nom : </p>
                    <img id='lastnameImg' alt='Edit' src='images/edit.png' width=17>
                    <?php 
                    echo "<p class='lastname'>".$row[0]['lastname']."</p>";
                    echo "<input class='lastname' value='".$row[0]['lastname']."' placeholder='...' type='text' style='display:none;'>";
                    ?>
                </li>
                <?php
                $row[0]["joinedon"] = date($dateFormat, strtotime($row[0]["joinedon"]));
                echo "<li><p class='red'>Date d'inscription : </p><p>".$row[0]['joinedon']."</p></li>";
                echo "<li><a class='pwdch' href='user_handling/change_password.php'>Changer de mot de passe</a></li>";
                
                ?>
            </ul></div>
            <?php echo "<input type='hidden' id='accountId' value='".$_SESSION['user_id']."'>"; ?>
            <input value="Enregister les modification" id='submitAccountData' type="submit" style='width:auto;'>
        </div>
    </article>
</section>
<div id="AccountImgModal" class="modal">
<!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span id='closeImgModal' class="close">&times;</span>
            <h2>Ajouter/modifier l'image de profil</h2>
        </div>
        <div class="modal-body">
            <div id='AccountImgDiv'><img width=100 style='display:none;' id='AccountImg'></div>
            Sélectionner une image à importer :
            <form method='post' enctype="multipart/form-data">
                <input style='margin-left:10px;' type="file" name="fileUpload" id="AccountImgUpload">
                <div><input type="submit" id='submitAccountImg' style='width:auto' value="Importer"></div>
            </form>
        </div>
        <div class="modal-footer">
            <h3><u>Conseil</u> : Il est conseillé d'importer uniquement des images en carré pour éviter qu'elles soient décentrées à l'affichage.</h3>
        </div>
    </div>
</div>
<?php }
include('footer.php');
?>