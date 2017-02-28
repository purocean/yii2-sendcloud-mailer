<?php
namespace test;

require '../vendor/autoload.php';
require '../vendor/yiisoft/yii2/Yii.php';

use SendcloudMailer\Mailer;

// http://sendcloud.sohu.com/doc/email_v2/send_email/
$mailer = new Mailer([
    'viewPath' => './',
    'apiUser' => 'xxxxx',
    'apiKey' => 'xxxxx',
    'from' => 'xxxxx@gmail.com',
    'fromName' => 'xxxxx',
]);

$mailer->compose(
    ['html' => 'template_html'],
    ['var' => 'HELLOWORLD!']
)->setTo('xxxxx@outlook.com')
->setCc(['xxxxx@gmail.com' => 'xxxxx', 'xxxxx@qq.com' => null])
->setSubject("test subject")
->send();
