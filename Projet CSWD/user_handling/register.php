<?php
require_once("config.php");
require_once("session.php");

if (count($_SESSION) != 0) {
    header("location: ../index.php");
}

date_default_timezone_set('Etc/UTC');
include("../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$valid = false; $error = ""; $alert = "";
$menu["title"] = "S'inscrire";

if (isset($_POST) && (!empty($_POST))) {
    $newuser = array();
    $newuser["Password"] = $_POST["password"];
    $newuser["Email"] = $_POST["email"];
    $newuser["Username"] = $_POST["username"];

    if (isset($_POST["firstname"])) {
        $newuser["Firstname"] = $_POST["firstname"];
    } else {$newuser["Firstname"] = "";}
    if (isset($_POST["lastname"])) {
        $newuser["Lastname"] = $_POST["lastname"];
    } else {$newuser["Lastname"] = "";}

    foreach ($newuser as $key => $value) {
        if ($key == "Email" or $key == "Username") {
            $result = $pdo->prepare("SELECT id FROM user WHERE ".$key." = ?");
            $result->execute(array($value));
            $row = $result->fetchAll(PDO::FETCH_ASSOC); 
            $count = count($row);
        }
        if ($key == "Email" && $count > 0) { // > 0 ou ==1 mais ici on travaille avec un accès direct à la base de données alors les erreurs arrivent facilement
            $error = "Cette adresse mail est déjà utilisée !";
            $newuser["Email"] = "";
            $valid = false; break;
        } elseif ($key == "Username" && $count > 0) {
            $error = "Ce pseudo est déjà utilisé !";
            $newuser["Username"] = "";
            $valid = false; break;
        } elseif ($_POST["password"] != $_POST["c_password"]) {
            $error = "Les mots de passe ne correspondent pas !";
            $valid = false; break;
        } else {$valid = true;}
    }   
} else {
    $newuser = array();
    $newuser["Password"] = "";
    $newuser["Email"] = "";
    $newuser["Username"] = "";
}
if ($valid) {
    $username = $newuser['Username']; $password = $newuser['Password'];
    $email = $newuser['Email']; $firstname = $newuser['Firstname'];
    $lastname = $newuser['Lastname'];
    $query_create = "INSERT INTO user (id, username, password, email, verified, firstname, lastname, likes, joinedon)
            VALUES (NULL, '$username', MD5('$password'), '$email', 0, '$firstname', '$lastname', 0, NOW())";
    $result = $pdo->prepare($query_create);
    $result->execute();

    try {

        $mail = new \PHPMailer(true);
        $mail->Timeout  = 15;

        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'storystoire@gmail.com';
        $mail->Password = 'labichusdragibus';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('storystoire@gmail.com', 'Storystoire - Inscription');
        $mail->addAddress($email);
    
        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        $mail->Subject = 'Votre inscription à Storystoire a bien été prise en compte !';
        
        $body = file_get_contents('../emails/email_confirmation.html');
        $body = str_replace('%username%', $username, $body); 
        $body = str_replace('%password%', $password, $body);
        $body = str_replace('%email%', $email, $body);
        $firstname = (empty($firstname))?"Non renseigné":$firstname;
        $lastname = (empty($lastname))?"Non renseigné":$lastname;
        $body = str_replace('%firstname%', $firstname, $body);
        $body = str_replace('%lastname%', $lastname, $body); 

        $mail->Body = $body;
        $mail->send();
        
        $alert = "Un mail de confirmation vous a été envoyé !";
    } catch (Exception $e) {
        $alert = "Une erreur s'est produite à l'envoie du mail de confirmation !";
    }

    // $query_retrieve = "SELECT id, username FROM user WHERE email = ? and password = MD5(?)";
    // $result = $pdo->prepare($query_retrieve);
    // $result->execute(array($email, $password));
    // $row = $result->fetchAll(PDO::FETCH_ASSOC);
    // $_SESSION['user_id'] = $row[0]['id'];
    // $_SESSION['login_user'] = $row[0]['username'];
    // header("location: ../index.php");
    header("location: register_confirmation.php?reg=1");
}
$dir1 = "../";
include("../main_header.php");
?>
<section style="margin-right:-150px;">
    <article class="card">
        <div>
            <form action="" method="post">
                <h2>Inscription</h2><hr>
                <p>* Nom d'utilisateur :</p><input type="text" name="username" placeholder="..." required <?php echo 'value='.$newuser['Username']; ?>>
                <p>* Adresse Email :</p><input type="email" name="email" placeholder="..." required <?php echo "value=".$newuser["Email"]; ?>>
                <p>* Mot de passe :</p><input type="password" name="password" placeholder="..." required>
                <p>* Confirmation de mot de passe :</p><input type="password" name="c_password" placeholder="..." required>
        </div>
    </article>
</section>
<section>
    <article class="card">
        <div>
                <p>Prénom :</p><input type="text" name="firstname" placeholder="...">
                <p>Nom :</p><input type="text" name="lastname" placeholder="...">
                <p style="font-size:11px;">Les champs précédés d'une étoile * sont indispensables.</p><input type="submit" value="Valider">
                <p  class="alert"><?php echo $error ?></p>
                <p  class="alert"><?php echo $alert ?></p>
            </form>
        </div>
    </article>
</section>
<?php include("../footer.php"); ?>