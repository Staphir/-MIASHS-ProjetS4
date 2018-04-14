<?php
$menu["title"] = "S'inscrire";
require_once("config.php");
require_once("session.php");
include("../secondary_header.php");
$error = "";

include("../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!empty($_POST)) {
    $myemail = $_POST['email'];
    $query = "SELECT id FROM user WHERE email = ? and verified = '0'";
    $result=$pdo->prepare($query);
    $result->execute(array($myemail));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);

    if ($count == 1) {
        try {
            $fp = stream_socket_client("tcp://smtp.gmail.com:587", $errno, $errstr, 30);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } else {
                while (!feof($fp)) {
                    echo fgets($fp, 1024);
                }
                fclose($fp);
            }

            $mail = new \PHPMailer(true);
            $mail->SMTPDebug = 4;
            $mail->Timeout  = 10;
    
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'tls://smtp.gmail.com:587';
            $mail->SMTPAuth = true;
            $mail->Username = 'storystoire@gmail.com';
            $mail->Password = 'labichusdragibus';
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAutoTLS = false;
            $mail->Port = 587;
        
            //Recipients
            $mail->setFrom('storystoire@gmail.com', 'Storystoire - Inscription');
            $mail->addAddress($myemail);
        
            //Content
            $mail->isHTML(true);
            $mail->Subject = "Re-confirmation d'inscription";
            
            $body = "
            <html>
                <meta http-equiv='Content-Type' content='text/html' charset='utf-8' /> 
                <title>Storystoire</title>
                <body style='margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; font-family: Trebuchet MS, Arial, Verdana, sans-serif;'>
                    <p><strong>Bienvenue sur Storystoire!</strong> Vous pouvez confirmer votre inscription à Storystoire en cliquant <a href='https://pedagovic.uf-mi.u-bordeaux.fr/~mdevreese/cswd/projet2018/user_handling/confirm.php?email=".$myemail."'>ici</a>.</p>
                    <p>Si vous rencontrez un problème lors de l'utilisation de notre site, vous pouvez nous contacter via la page dédiée sur Storystoire.</p>
                    <p>Amusez-vous bien !</p>
                    <p>L'équipe de Storystoire</p>
                </body>
            </html>
            ";
    
            $mail->Body = $body;
            $mail->send();
            
            $result = "Un mail de confirmation vous a été envoyé !";
        } catch (Exception $e) {
            $result = "Une erreur s'est produite, à l'envoie du mail de confirmation";
        }
    } else {$error = "Cette adresse mail est déjà validé ou n'existe pas dans notre base de données !";}
}

if ($_GET["reg"] == 0) {
    ?>
    <div class="confirm">
        <div>
            <h1>Activez votre compte grâce à votre email</h1><hr>
            <p>Votre compte n'est pas activé et vous ne pouvez pas vous connecter ? Avant de pouvoir vous connecter, vous devez valider votre inscription depuis le mail qui vous a été envoyé.</p>
            <p>Si le mail ne vous est toujours pas parvenu, vous pouvez renvoyer le mail ci-dessous en entrant votre adresse mail :</p>
        </div>
        <form method="post" action="">
            <input type="email" name="email" placeholder="..." required>
            <input type="submit" value="Renvoyer">
            <p style="color:red"><?php echo $error; ?></p>
        </form>
    </div>
    <?php
} elseif ($_GET["reg"] == 1) {
    ?>
    <div class="confirm">
        <h1>Confirmation d'inscritpion</h1><hr>
        <p>Votre demande d'inscription a bien été prise en compte. Afin de valider et de terminer votre inscription à Storystoire merci de valider votre adresse email depuis le mail qui vous a été envoyé.</p>
        <p>Si le mail ne vous est pas parvenu, tentez de vous connecter avec vos identifiants renseignés précédemment, vous aurez alors la possibilité de renvoyer le mail.</p>
        <p>À bientôt !</p>
    </div>
    <?php
} elseif ($_GET["reg"] == 2) {
    ?>
    <div class="confirm">
        <h1>Confirmation d'inscritpion</h1><hr>
        <p>Votre compte est vérifié vous pouvez vous connecter !</p>
        <p>À bientôt !</p>
    </div>
    <?php
} else {header("location: user_handling/register.php");}

include("../footer.php");
?>