<?php
require_once("config.php");
require_once("session.php");

if (count($_SESSION) != 0) {
    header("location: ../index.php");
}

date_default_timezone_set('Etc/UTC');
include("../vendor/autoload.php");
include("../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");
// require_once("../emails/validation/smtp_validateEmail.class.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$valid = true; $error = ""; $alert = "";
$menu["title"] = "S'inscrire";

if (isset($_POST) && (!empty($_POST))) {
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Core.Encoding', 'ISO-8859-1');
    $config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
    $config->set('HTML.Allowed', '');
 
    $purifier = new HTMLPurifier($config);

    $newuser = array();
    $newuser["Password"] = $_POST["password"];
    $newuser["Email"] = $_POST["email"];
    $newuser["Username"] = $purifier->purify($_POST["username"]);

    $newuser["Firstname"] = (isset($_POST["firstname"]))?$purifier->purify($_POST["firstname"]):"";
    $newuser["Lastname"] = (isset($_POST["lastname"]))?$purifier->purify($_POST["lastname"]):"";

    $valid_email = \PHPMailer::ValidateAddress($_POST["email"]);
    // $SMTP_Validator = new SMTP_validateEmail();
    // $SMTP_Validator->debug = true;
    // $valid_email = $SMTP_Validator->validate(array($newuser["Email"]), "storystoire@gmail.com");

    if ($valid_email) {
        foreach ($newuser as $key => $value) {
            if ($key == "Email" or $key == "Username") {
                $result = $pdo->prepare("SELECT id FROM user WHERE ".$key." = ?");
                $result->execute(array($value));
                $row = $result->fetchAll(PDO::FETCH_ASSOC); 
                $count = count($row);
            } if ($key == "Username" && !(strlen($value) < 13 && strlen($value) > 4)) {
                $error = "Le nom d'utilisateur doit contenir entre 5 et 12 caractères !";
                $newuser["Username"] = "";
                $valid = false; break;
            } if ($key == "Email" && $count > 0) { // > 0 ou ==1 mais ici on travaille avec un accès direct à la base de données alors les erreurs arrivent facilement
                $error = "Cette adresse mail est déjà utilisée !";
                $newuser["Email"] = "";
                $valid = false; break;
            } if ($key == "Username" && $count > 0) {
                $error = "Ce pseudo est déjà utilisé !";
                $newuser["Username"] = "";
                $valid = false; break;
            } if ($key == "Password" && !(strlen($value) > 7)) {
                $error = "Le mot de passe doit contenir au moins 8 caractères !";
                $valid = false; break;
            } if ($key == "Password" && $value != $_POST["c_password"]) {
                $error = "Les mots de passe ne correspondent pas !";
                $valid = false; break;
            }
        }
    } else {
        $error = "Cette adresse mail est invalide !";
        $valid = false;
    } 
    if ($valid) {
        $username = $newuser['Username']; $password = password_hash(trim($newuser['Password']), PASSWORD_BCRYPT);
        $email = $newuser['Email']; $firstname = $newuser['Firstname'];
        $lastname = $newuser['Lastname'];
        $query_create = "INSERT INTO user (id, username, password, email, verified, firstname, lastname, likes, joinedon)
                VALUES (NULL, '$username', '$password', '$email', 0, '$firstname', '$lastname', 0, NOW())";
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
            $mail->Password = 'gdckhyhzsobirurz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('storystoire@gmail.com', 'Storystoire - Inscription');
            $mail->addAddress($email);
        
            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'utf-8';
            $mail->Subject = "Confirmation d'inscription !";
            
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
        header("location: register_confirmation.php?reg=1");
    }
} else {
    $newuser = array();
    $newuser["Password"] = "";
    $newuser["Email"] = "";
    $newuser["Username"] = "";
}
$dir1 = "../";
include("../main_header.php");
?>
<form method="post">
<section style="margin-right:-150px;">
    <article class="card" style='margin-top:70px'>
        <div>
            <h2>Inscription</h2><hr>
            <p>* Nom d'utilisateur :</p><input type="text" name="username" placeholder="..." required <?php echo 'value='.($newuser['Username'])?$newuser['Username']:""; ?>>
            <p>* Adresse Email :</p><input type="email" name="email" placeholder="..." required <?php echo "value=".($newuser["Email"])?$newuser["Email"]:""; ?>>
            <p>* Mot de passe :</p><input type="password" name="password" placeholder="..." required>
            <p>* Confirmation de mot de passe :</p><input type="password" name="c_password" placeholder="..." required>
        </div>
    </article>
</section>
<section>
    <article class="card">
        <div>
            <h2>Attention !</h2><hr>
            <p>Ne pas renseigner de faux emails sinon vous ne pourrez pas activer votre compte ! De plus, ça nous spam avec des Mail Delivery Subsystem Failure qui contiennent vos données personnelles !</p>
        </div>
    </article>
    <article class="card">
        <div>
            <p>Prénom :</p><input type="text" name="firstname" placeholder="...">
            <p>Nom :</p><input type="text" name="lastname" placeholder="...">
            <p style="font-size:11px;">Les champs précédés d'une étoile * sont indispensables.</p><input type="submit" value="Valider">
            <p  class="alert"><?php echo $error ?></p>
            <p  class="alert"><?php echo $alert ?></p>
        </div>
    </article>
</section>
</form>

<?php include("../footer.php"); ?>