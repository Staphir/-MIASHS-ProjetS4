<?php
$menu["title"] = "Contact"; $alert = "";
include("main_header.php");
include("vendor/phpmailer/phpmailer/PHPMailerAutoload.php");


if (!empty($_SESSION)) {
    $user_email = $_SESSION["user_email"];
    $user_username = $_SESSION["login_user"];
} else {
    $user_email = "";
    $user_username = "";
}

$user_comment = "";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST) && (!empty($_POST))) {
    $user_comment = $_POST["comment"];

    $valid_email = \PHPMailer::ValidateAddress($_POST["email"]);

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
            $mail->Password = 'labichusdragibus';
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
            <body>
                <p><strong>Nom d'utilisateur : </strong>".$user_username."</p>
                <p><strong>Adresse email : </strong>".$user_email."</p>
                <p><strong>Commentaire :  </strong>".$user_comment."</p>
            </body>";

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
            $mail->Password = 'labichusdragibus';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
        
            //Recipients
            $mail->setFrom('storystoire@gmail.com', 'Storystoire - Support');
            $mail->addAddress($user_email);
        
            //Content
            $mail->isHTML(true);
            $mail->CharSet = 'utf-8';
            $mail->Subject = 'Commentez Storystoire !';
            $body = file_get_contents('emails/contact_confirmation.html');

            $mail->Body = $body;
            $mail->send();
            
            header("location: contact_sent.php");
        } catch (Exception $e) {
            $alert = "Une erreur s'est produite, veuillez réessayer ou nous contacter directement à l'adresse storystoire@gmail.com";
        }
    } else {$alert = "Adresse email invalide !";}
}

?>
<section>
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p>Si vous avez un problème, une question ou si vous voulez simplement nous dire à quel point notre travail est impressionnant vous êtes au bon endroit ! Vous pouvez nous joindre grâce à ce formulaire !</p>
            <p>L'un de nous vous répondra dans les plus brefs délais ! Dans l'espoir qu'on puisse vous aider, Maxime, Martin et Fannie.</p>
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
<?php include("footer.php"); ?>