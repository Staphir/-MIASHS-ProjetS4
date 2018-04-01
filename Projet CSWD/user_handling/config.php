<!-- https://www.tutorialspoint.com/php/php_mysql_login.htm -->

<?php 
// config locale
   define('DB_SERVER', '127.0.0.1');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'projet_cswd');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// config pedagovic
//    define('DB_SERVER', '127.0.0.1');
//    define('DB_USERNAME', 'mdevreese');
//    define('DB_PASSWORD', 'riEa#U%0');
//    define('DB_DATABASE', 'mdevreese');
//    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>