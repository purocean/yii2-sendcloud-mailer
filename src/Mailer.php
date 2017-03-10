<?php
namespace SendcloudMailer;

use Yii;
use yii\mail\BaseMailer;

/**
* Mailer
* @link http://sendcloud.sohu.com/doc/email_v2/send_email/
*/
class Mailer extends BaseMailer
{
    public $messageClass = 'SendcloudMailer\Message';

    public $apiUrl = 'http://api.sendcloud.net/apiv2/mail/send';
    public $apiUser;
    public $apiKey;
    public $from;
    public $fromName = '';

    private $_useHtml = false;
    private $_useText = false;

    public function compose($view = null, array $params = [])
    {
        if (is_null($view)) {
            $this->_useText = true;
            $this->_useHtml = true;
        } else {
            $this->_useHtml = isset($view['html']);
            $this->_useText = isset($view['text']);
        }

        return parent::compose($view, $params);
    }

    public function sendMessage($message)
    {
        $address = $message->getTo();
        if (is_array($address)) {
            $address = implode(', ', array_keys($address));
        }
        Yii::info('Sending email "' . $message->getSubject() . '" to "' . $address . '"', __METHOD__);

        $context  = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => http_build_query(array_filter([
                    'apiUser' => $this->apiUser,
                    'apiKey' => $this->apiKey,
                    'from' => $this->from,
                    'fromName' => $this->fromName,
                    'to' => $this->_parseAddress($message->getTo()),
                    'subject' => $message->getSubject(),
                    'html' => $this->_useHtml ? $message->getHtmlBody() : null,
                    'plain' => $this->_useText ? $message->getTextBody() : null,
                    'cc' => $this->_parseAddress($message->getCc()),
                    'bcc' => $this->_parseAddress($message->getBcc()),
                ])),
            ]
        ]);

        $result = json_decode(file_get_contents($this->apiUrl, FILE_TEXT, $context), true);

        if (isset($result['statusCode']) and $result['statusCode'] === 200) {
            return true;
        } else {
            Yii::warning($result, 'sendcloud-mailer');
        }

        return false;
    }

    private function _parseAddress($address)
    {
        if (is_string($address)) {
            return strtr($address, [
                ','  => ';',
                ' '  => ';',
                "\n" => ';',
            ]);
        }

        if (is_array($address)) {
            return implode(';', array_map(function ($key, $val) {
                if (is_numeric($key)) {
                    return $val;
                } else {
                    return $key;
                }
            }, array_keys($address), $address));
        }

        return null;
    }
}
