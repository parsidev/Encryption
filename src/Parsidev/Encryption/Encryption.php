<?php

namespace Parsidev\Encryption;


class Encryption
{

    protected $keys;

    public function __construct($keys)
    {
        $this->keys = $keys;
    }

    protected function getCode($key, $text)
    {
        $outText = '';
        for ($i = 0; $i < strlen($text);) {
            for ($j = 0; ($j < strlen($key) && $i < strlen($text)); $j++, $i++) {
                $outText .= $text{$i} ^ $key{$j};
            }
        }
        return ($outText);
    }

    public function encrypt($plainText)
    {
        $encrypted = $plainText;
        foreach ($this->keys as $key) {
            $encrypted = $this->getCode($key, $encrypted);
        }
        return bin2hex($encrypted);
    }

    public function decrypt($decryptedText)
    {
        $decrypted = $this->hex2bin($decryptedText);
        for ($i = count($this->keys) - 1; $i >= 0; $i--) {
            $decrypted = $this->getCode($this->keys[$i], $decrypted);
        }
        return $decrypted;
    }

    protected function hex2bin($hexData)
    {
        $binData = '';
        for ($i = 0; $i < strlen($hexData); $i += 2) {
            $binData .= chr(hexdec(substr($hexData, $i, 2)));
        }
        return $binData;
    }

}
