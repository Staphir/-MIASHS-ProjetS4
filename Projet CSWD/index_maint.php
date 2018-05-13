<!DOCTYPE>
<html lang=fr>
    <head>
        <title>Storystoire</title>
    </head>
    <body>
        <?php echo count($_SESSION), '  ', empty($_SESSION)?'true':'false'; ?>
        <p>Merci de patienter. - L'équipe</p>
        <p>Version PHP : <?php echo phpversion() ?></p>
    </body>
</html>