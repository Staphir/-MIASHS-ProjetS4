<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf88725f312d5aa5a8e6ed11229095957
{
    public static $prefixLengthsPsr4 = array (
        'h' => 
        array (
            'hbattat\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'hbattat\\' => 
        array (
            0 => __DIR__ . '/..' . '/hbattat/verifyemail/src',
        ),
    );

    public static $classMap = array (
        'EasyPeasyICS' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/EasyPeasyICS.php',
        'PHPMailer' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
        'PHPMailerOAuth' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauth.php',
        'PHPMailerOAuthGoogle' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmaileroauthgoogle.php',
        'POP3' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.pop3.php',
        'SMTP' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.smtp.php',
        'ntlm_sasl_client_class' => __DIR__ . '/..' . '/phpmailer/phpmailer/extras/ntlm_sasl_client.php',
        'phpmailerException' => __DIR__ . '/..' . '/phpmailer/phpmailer/class.phpmailer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf88725f312d5aa5a8e6ed11229095957::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf88725f312d5aa5a8e6ed11229095957::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf88725f312d5aa5a8e6ed11229095957::$classMap;

        }, null, ClassLoader::class);
    }
}
