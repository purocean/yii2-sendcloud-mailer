# Yii2 Sendcloud Mailer
    A sendcloud email component for yii2

## Usage
```php
// append to yii application config file.
    'components' => [
        // ...
        'mailer' => [
            'class'            => 'SendcloudMailer\Mailer',
            'viewPath'         => '@app/mail',
            'useFileTransport' => false,

            // sendcloud params
            'apiUser'          => 'xxxxx',
            'apiKey'           => 'xxxxx',
            'from'             => 'xxxxx@gmail.com',
            'fromName'         => 'xxxxx',
        ],
        // ...
    ]

// some php file
Yii::$app
    ->mailer
    ->compose(
        ['html' => 'template_html'],
        ['var' => 'HELLOWORLD!']
    )
    ->setTo('xxxxx@gmail.com')
    ->setCc('xxxxx@qq.com')
    ->setSubject('subject')
    ->send();
```

## Test
```bash
cd test
vim test.php # config params
php test.php
```
