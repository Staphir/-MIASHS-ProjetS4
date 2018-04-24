<?php
$menu["title"] = "S'inscrire";
$dir1 = "../";
include("../main_header.php");
$error = ""; $alert = "";

include("../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!empty($_POST)) {
    $myemail = $_POST['email'];
    $query = "SELECT id FROM user WHERE email = ? and verified = 0";
    $result=$pdo->prepare($query);
    $result->execute(array($myemail));
    $row = $result->fetchAll(PDO::FETCH_ASSOC);
    $count = count($row);

    if ($count == 1) {
        try {

            $mail = new \PHPMailer(true);
    
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
            $mail->CharSet = 'utf-8';
            $mail->Subject = "Re-confirmation d'inscription";
            
            $body = file_get_contents('../emails/email_confirmation2.html');
            $body = str_replace('%email%', $myemail, $body);
    
            $mail->Body = $body;
            $mail->send();
            
            $alert = "Un mail de confirmation vous a été envoyé !";
        } catch (Exception $e) {
            $alert = "Une erreur s'est produite, à l'envoie du mail de confirmation";
        }
    } else {$error = "Cette adresse mail est déjà validé ou n'existe pas dans notre base de données !";}
}
?><section><article class="card"><?php
if ($_GET["reg"] == 0) {
    ?>
        <div>
            <h2>Activez votre compte grâce à votre email</h2><hr>
            <p>Votre compte n'est pas activé et vous ne pouvez pas vous connecter ? Avant de pouvoir vous connecter, vous devez valider votre inscription depuis le mail qui vous a été envoyé.</p>
            <p>Si le mail ne vous est toujours pas parvenu, vous pouvez renvoyer le mail ci-dessous en entrant votre adresse mail :</p>
            <form method="post" action="">
                <input type="email" name="email" placeholder="..." required>
                <input type="submit" value="Renvoyer">
            </form>
            <p class="alert"><?php echo $error; ?></p>
            <p class="alert"><?php echo $alert; ?></p>
        </div>
    <?php
} elseif ($_GET["reg"] == 1) {
    ?>
    <div>
        <h2>Confirmation d'inscritpion</h2><hr>
        <p class="alert">Votre demande d'inscription a bien été prise en compte !</p>
        <p>Afin de valider et de terminer votre inscription à Storystoire merci de valider votre adresse email depuis le mail qui vous a été envoyé.</p>
        <p>Si le mail ne vous est pas parvenu, tentez de vous connecter avec vos identifiants renseignés précédemment, vous aurez alors la possibilité de renvoyer le mail.</p>
        <p>À bientôt !</p>
    </div>
    <?php
} elseif ($_GET["reg"] == 2) {
    ?>
    <div>
        <h2>Confirmation d'inscritpion</h2><hr>
        <p>Votre compte est vérifié vous pouvez vous connecter !</p>
        <p>À bientôt !</p>
    </div>
    <?php
} else {header("location: register.php");}
?></article></section><?php
include("../footer.php");
?>