<?php
return  [
          'class' => 'yii\swiftmailer\Mailer',
          'transport' => [
              'class' => 'Swift_SmtpTransport',
              'host' => 'mail.nregaup.in',
              'username' => 'webadmin@nregaup.in',
              'password' => 'webadmin321',
              'port' => '25',
            // 'encryption' => 'tls',
          ],
    ];
?>