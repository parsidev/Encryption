<?php

namespace Parsidev\Encryption;


class Encryption
{

    protected $keys;

    public function __construct($keys)
    {
        $this->keys = $keys;
    }

    public function encrypt($plainText)
    {
        $message = base64_encode($plainText);
        $ml = strlen($message);
        foreach ($this->keys as $key) {
            $kl = strlen($key);
            $tmp = "";
            for ($i = 0; $i < $ml; $i++) {
                $tmp = $tmp . ($message[$i] ^ $key[$i % $kl]);
            }
            $message = $tmp;
            $ml = strlen($message);
        }
        return bin2hex($message);
    }

    public function decrypt($decryptedText)
    {
        $msg = $this->hex2bin($decryptedText);
        $ml = strlen($msg);
        foreach ($this->keys as $key) {
            $kl = strlen($key);
            $tmp = "";
            for ($i = 0; $i < $ml; $i++) {
                $tmp = $tmp . ($msg[$i] ^ $key[$i % $kl]);
            }
            $msg = $tmp;
            $ml = strlen($msg);
        }
        return base64_decode($msg);
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
