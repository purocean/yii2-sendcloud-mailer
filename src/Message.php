<?php
namespace SendcloudMailer;

use yii\mail\BaseMessage;

/**
* Message
*/
class Message extends BaseMessage
{
    private $_charset = 'UTF-8';
    private $_to = '';
    private $_replayTo = '';
    private $_cc = '';
    private $_bcc = '';
    private $_subject = '';
    private $_text = '';
    private $_html = '';


    public function getCharset()
    {
        return $this->_charset;
    }

    public function setCharset($charset)
    {
        $this->_charset = $charset;
        return $this;
    }

    public function getFrom()
    {
        // not implement

        return null;
    }

    public function setFrom($from)
    {
        // not implement

        return $this;
    }

    public function getFromName()
    {
        return null;
    }

    public function setFromName($fromName)
    {
        // not implement

        return $this;
    }

    public function getTo()
    {
        return $this->_to;
    }

    public function setTo($to)
    {
        if (is_string($to)) {
            $this->_to = [$to => null];
        } elseif (is_array($to)) {
            $this->_to = $to;
        }

        return $this;
    }

    public function getReplyTo()
    {
        return implode(';', array_keys($this->_replayTp));
    }

    public function setReplyTo($replyTo)
    {
        if (is_string($replayTo)) {
            $this->_replayTo = [$replayTo => null];
        } elseif (is_array($replayTo)) {
            $this->_replayTo = $replayTo;
        }

        return $this;
    }

    public function getCc()
    {
        return $this->_cc;
    }


    public function setCc($cc)
    {
        if (is_string($cc)) {
            $this->_cc = [$cc => null];
        } elseif (is_array($cc)) {
            $this->_cc = $cc;
        }

        return $this;
    }

    public function getBcc()
    {
        return $this->_bcc;
    }

    public function setBcc($bcc)
    {
        if (is_string($bcc)) {
            $this->_bcc = [$bcc => null];
        } elseif (is_array($bcc)) {
            $this->_bcc = $bcc;
        }

        return $this;
    }

    public function getSubject()
    {
        return $this->_subject;
    }

    public function setSubject($subject)
    {
        $this->_subject = $subject;

        return $this;
    }

    public function setTextBody($text)
    {
        $this->_text = $text;

        return $this;
    }

    public function setHtmlBody($html)
    {
        $this->_html = $html;

        return $this;
    }

    public function getTextBody()
    {
        return $this->_text;
    }

    public function getHtmlBody()
    {
        return $this->_html;
    }

    public function attach($fileName, array $options = [])
    {
        // not implement

        return $this;
    }

    public function attachContent($content, array $options = [])
    {
        // not implement

        return $this;
    }

    public function embed($fileName, array $options = [])
    {
        // not implement

        return $this;
    }

    public function embedContent($content, array $options = [])
    {
        // not implement

        return $this;
    }

    public function toString()
    {
        return $this->_subject;
    }
}
