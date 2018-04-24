<?php
$host = 'smtp.gmail.com';
    $port = "587";
    $checkconn = fsockopen($host, $port, $errno, $errstr, 5);
    if(!$checkconn){
        echo "($errno) $errstr";
    } else {
        echo 'ok';
    }

// Warning: fsockopen(): unable to connect to smtp.gmail.com:587 (Connection timed out) in /home/mdevreese/www/cswd/projet2018/index2.php on line 4
// (110) Connection timed out



// *****************************************************************
// *****************************************************************



$f = fsockopen('smtp.gmail.com', 25) ;
if ($f !== false) {
    $res = fread($f, 1024) ;
    if (strlen($res) > 0 && strpos($res, '220') === 0) {
        echo "Success!" ;
    }
    else {
        echo "Error: " . $res ;
    }
}
fclose($f) ;

// Warning: fsockopen(): unable to connect to smtp.gmail.com:25 (Connection timed out) in /home/mdevreese/www/cswd/projet2018/index2.php on line 22
// (Warning: fclose() expects parameter 1 to be resource, boolean given in /home/mdevreese/www/cswd/projet2018/index2.php on line 32)



// *****************************************************************
// *****************************************************************



$ports[] = array('host'=>'interspire.smtp.com','number'=>25);
$ports[] = array('host'=>'interspire.smtp.com','number'=>2525);
$ports[] = array('host'=>'interspire.smtp.com','number'=>25025);
$ports[] = array('host'=>'helpme.interspire.smtp.com','number'=>80);

$ports[] = array('host'=>'google.com','number'=>80);
$ports[] = array('host'=>'smtp.gmail.com','number'=>587);
$ports[] = array('host'=>'smtp.gmail.com','number'=>465);
$ports[] = array('host'=>'pop.gmail.com','number'=>995);
$ports[] = array('host'=>'imap.gmail.com','number'=>993);

$ports[] = array('host'=>'ftp.mozilla.org','number'=>21);
$ports[] = array('host'=>'smtp2go.com','number'=>8025);

$ports[] = array('host'=>'relay.dnsexit.com','number'=>25);
$ports[] = array('host'=>'relay.dnsexit.com','number'=>26);
$ports[] = array('host'=>'relay.dnsexit.com','number'=>940);
$ports[] = array('host'=>'relay.dnsexit.com','number'=>8001);
$ports[] = array('host'=>'relay.dnsexit.com','number'=>2525);
$ports[] = array('host'=>'relay.dnsexit.com','number'=>80);

$ports[] = array('host'=>'mail.authsmtp.com','number'=>23);
$ports[] = array('host'=>'mail.authsmtp.com','number'=>25);
$ports[] = array('host'=>'mail.authsmtp.com','number'=>26);
$ports[] = array('host'=>'mail.authsmtp.com','number'=>2525);

foreach ($ports as $port)
{
    //$connection = @fsockopen($port['host'], $port['number']);
    $connection = @fsockopen($port['host'], $port['number'], $errno, $errstr, 5); // 5 second timeout for each port.

    if (is_resource($connection))
    {
        echo '<h2>' . $port['host'] . ':' . $port['number'] . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

        fclose($connection);
    }

    else
    {
        echo '<h2>' . $port['host'] . ':' . $port['number'] . ' is not responding.</h2>' . "\n";
    }
}

// ***** OUTPUT *****

// interspire.smtp.com:25 is not responding.
// interspire.smtp.com:2525 is not responding.
// interspire.smtp.com:25025 is not responding.

// Warning: getservbyport() expects parameter 1 to be long, array given in /home/mdevreese/www/cswd/projet2018/index2.php on line 63
// helpme.interspire.smtp.com:80 () is open.

// Warning: getservbyport() expects parameter 1 to be long, array given in /home/mdevreese/www/cswd/projet2018/index2.php on line 63
// google.com:80 () is open.
// smtp.gmail.com:587 is not responding.
// smtp.gmail.com:465 is not responding.
// pop.gmail.com:995 is not responding.
// imap.gmail.com:993 is not responding.
// ftp.mozilla.org:21 is not responding.
// smtp2go.com:8025 is not responding.
// relay.dnsexit.com:25 is not responding.
// relay.dnsexit.com:26 is not responding.
// relay.dnsexit.com:940 is not responding.
// relay.dnsexit.com:8001 is not responding.
// relay.dnsexit.com:2525 is not responding.

// Warning: getservbyport() expects parameter 1 to be long, array given in /home/mdevreese/www/cswd/projet2018/index2.php on line 63
// relay.dnsexit.com:80 () is open.
// mail.authsmtp.com:23 is not responding.
// mail.authsmtp.com:25 is not responding.
// mail.authsmtp.com:26 is not responding.
// mail.authsmtp.com:2525 is not responding.
?>