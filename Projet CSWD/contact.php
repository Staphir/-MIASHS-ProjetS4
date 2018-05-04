<?php
$menu["title"] = "Contact"; $alert = "";
include("main_header.php");
include("vendor/autoload.php");
include("vendor/phpmailer/phpmailer/PHPMailerAutoload.php");
// require_once("emails/validation/smtp_validateEmail.class.php");
// print_r($_SERVER);
// $_SESSION["current_url"] = (isset($_SERVER['HTTPS'])?"https":"http")."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (empty($_SESSION)) {
    $displayForm = false;
} else {
    $displayForm = true;
    $user_email = $_SESSION["user_email"];
    $user_username = $_SESSION["login_user"];

    $user_comment = "";

    if (isset($_POST) && (!empty($_POST))) {

        $config = HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'ISO-8859-1');
        $config->set('Cache.DefinitionImpl', null); // TODO: remove this later!
        $config->set('HTML.Allowed', 'a[href],i,b,img[src],font[style|size],ol,ul,li,br');
     
        $purifier = new HTMLPurifier($config);
        $user_comment = $purifier->purify($_POST['comment']);

        $valid_email = \PHPMailer::ValidateAddress($_POST["email"]);
        // $SMTP_Validator = new SMTP_validateEmail();
        // $SMTP_Validator->debug = true;
        // $valid_email = $SMTP_Validator->validate(array($user_email), "storystoire@gmail.com");

        if ($valid_email) {
            $user_email = $_POST["email"];
            try {
                $mail = new \PHPMailer(true);
                
                $mail->timeout = 5;
                $mail->Debugoutput = 'html';

                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Username = 'storystoire@gmail.com';
                $mail->Password = 'gdckhyhzsobirurz';
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Port = 587;

                //Recipients
                $mail->setFrom('storystoire@gmail.com', 'Commentaires Utilisateurs');
                $mail->addAddress('storystoire@gmail.com');

                //Content
                $mail->isHTML(true);
                $mail->CharSet = 'utf-8';
                $mail->Subject = 'Commentaire de '.$user_username;
                $mail->Body    = "
                <!DOCTYPE html>
                <html>
                    <body>
                        <p><strong>Nom d'utilisateur : </strong>".$user_username."</p>
                        <p><strong>Adresse email : </strong>".$user_email."</p>
                        <p><strong>Commentaire :  </strong>".$user_comment."</p>
                    </body>
                </html>";

                $mail->send();
                unset($mail);

                // --------------------------

                $mail = new \PHPMailer(true);

                $mail->timeout = 5;
                $mail->Debugoutput = 'html';

                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'storystoire@gmail.com';
                $mail->Password = 'gdckhyhzsobirurz';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
            
                //Recipients
                $mail->setFrom('storystoire@gmail.com', 'Storystoire - Support');
                $mail->addAddress($user_email);
            
                //Content
                $mail->isHTML(true);
                $mail->CharSet = 'utf-8';
                $mail->Subject = 'Commentez Storystoire !';
                $mail->Body = file_get_contents('emails/contact_confirmation.html');
                $mail->send();
                
                header("location: contact_sent.php");
            } catch (Exception $e) {
                $alert = "Une erreur s'est produite, veuillez réessayer ou nous contacter directement à l'adresse storystoire@gmail.com";
            }
        } else {$alert = "Adresse email invalide !";}
    }
}

if ($displayForm) { ?>
<section>
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p class="alert">Si vous avez un problème, une question ou si vous voulez simplement nous dire à quel point notre travail est impressionnant vous êtes au bon endroit ! Vous pouvez nous joindre grâce à ce formulaire !</p>
            <p>L'un de nous vous répondra dans les plus brefs délais ! Dans l'espoir qu'on puisse vous aider, Maxime, Martin et Fannie.</p>
        </div>
    </article>
    <article class="card">
        <div>
            <h2>Attention !</h2><hr>
            <p>Ne pas renseigner de faux emails, ça ne fait que spammer les serveurs de mails avec de fausses requêtes inutiles. De plus, ça nous spam avec des Mail Delivery Subsystem Failure...</p>
            <p>Cordialement - L'équipe</p>
        </div>
    </article>
    <article class="card">
        <div>
            <form method="post" action="">
                <h2>Remplir le formulaire</h2><hr>
                <?php
                echo "<p>Nom d'utilisateur : </p><input type='text' name='username' placeholder='...' value='".$user_username."' required></br>";
                echo "<p>Adresse Email : </p><input type='email' name='email' placeholder='...' value='".$user_email."' required></br>";
                echo "<p>Votre commentaire ici : </p><textarea type='comment' id='contact' name='comment' placeholder='...' value='".$user_comment."' required></textarea></br>";
                echo "<input type='submit' value='Envoyer'>"
                ?>
            </form>
            <p class="alert"><?php echo $alert; ?></p>
        </div>
    </article>
</section>
<?php
} else { ?>
<section>
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p class="alert">Si vous avez un problème, une question ou si vous voulez simplement nous dire à quel point notre travail est impressionnant vous êtes au bon endroit !</p>
            <p><strong>Une fois connecté</strong> vous aurez accès à un formulaire vous permettant de nous envoyer un commentaire.</p>
            <p>Bonne lecture - L'équipe</p>
        </div>
    </article>
</section>
<?php } include("footer.php"); ?>