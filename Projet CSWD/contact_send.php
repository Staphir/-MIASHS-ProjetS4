<?php
$menu["title"] = "Contact";
include("main_header.php");
$alert = "Ce service n'est pas encore opérationnel. Adressez-vous directement à storystoire@gmail.com.";
// include("vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

// $email = "devreese.martin@gmail.com";
// $message = "hello" ;

// // here we use the php mail function
// // to send an email to:
// // you@example.com
// mail( "devreese.martin@gmail.com", "Test PHP mail natif",$message, "From: $email" );
// echo "envoyé";

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

if (0) {
    // (isset($_POST) && (!empty($_POST))) {
    
    $user_comment = $_POST["comment"];
    $user_username = $_POST["username"];
    $user_email = $_POST["email"];
    
    $mail = new \PHPMailer(true);
    try {
        //Server settings
        $mail->timeout = 1;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'storystoire@gmail.com';
        $mail->Password = 'labichusdragibus';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('storystoire@gmail.com', 'Commentaires Utilisateurs');
        $mail->addAddress('storystoire@gmail.com');

        //Content
        $mail->isHTML(false);
        $mail->CharSet = 'utf-8';
        $mail->Subject = 'Commentaire de '.$user_username;
        $mail->Body    = "Nom d'utilisateur : ".$user_username." \r\n Adresse email : ".$user_email." \r\n Commentaire :  \r\n ".$user_comment;

        $mail->send();
        $alert = "Le message a bien été envoyé !";

        // --------------------------

        $mail = new \PHPMailer(true);

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
        $mail->isHTML(false);
        $mail->CharSet = 'utf-8';
        $mail->Subject = 'Commentez Storystoire !';
        $mail->Body = "Votre commentaire nous est parvenu et nous allons faire de notre mieux pour vous répondre dans les plus brefs délais. \r\n Merci de votre compréhension, 
        \r\n L'équipe de Storystoire
        \r\n\r\n Ceci est un mail automatique, merci de ne pas y répondre.";
    
        $mail->send();

    } catch (Exception $e) {
        $alert = "Une erreur s'est produite, veuillez réessayer ou contactez nous directement à l'aide de l'adresse storystoire@gmail.com";
    }
} else {
    // header("location: contact.php");
}
?>
<section>
    <article class="card">
        <div>
            <h2>Nous contacter</h2><hr>
            <p class="alert"><?php echo $alert; ?></p>
            <p>L'un de nous vous répondra dans les plus brefs délais ! Dans l'espoir qu'on puisse vous aider, Maxime, Martin et Fannie.</p>
            <p>Vous n'allez pas être redirigé vers la page d'accueil.</p>
            <!-- <script>setTimeout(function () {window.location.href = 'index.php';},5000)</script> -->
        </div>
    </article>
</section>
<?php include("footer.php"); ?>