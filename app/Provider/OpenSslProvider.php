<?php

namespace App\Provider;


class OpenSslProvider extends ProviderBase
{

    protected $key;
    protected $method;
    public function __construct($key = null, $method = null)
    {
        //Add default values
        if (is_null($key)) {
            $key = 'abcdefgh';
        }
        if (is_null($method)) {
            $method = 'aes-256-ecb';
        }
        $this->key = $key;
        $this->method = $method;
    }
    public function encrypt(string $text)
    {
        $ivSize = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encrypted = openssl_encrypt($text, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
        return $encrypted;
    }

    public function decrypt(string $text)
    {
        $ivSize = openssl_cipher_iv_length($this->method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $decrypted = openssl_decrypt($text, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
        return trim($decrypted);
    }
}
