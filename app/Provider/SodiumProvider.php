<?php

namespace App\Provider;


class SodiumProvider extends ProviderBase
{

    protected $secretKey;
    public function __construct(string $secretKey = null)
    {
        //Add default values
        if (is_null($secretKey)) {
            $secretKey = sodium_crypto_secretbox_keygen();
        }
        $this->secretKey = $secretKey;
    }
    public function encrypt(string $text)
    {
        $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
        $encrypted = base64_encode(
            $nonce . sodium_crypto_secretbox($text, $nonce, $this->secretKey)
        );
        return $encrypted;
    }

    public function decrypt(string $encrypted)
    {
        $decoded = base64_decode($encrypted);
        $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
        $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
        $decrypted = sodium_crypto_secretbox_open($ciphertext, $nonce, $this->secretKey);
        return $decrypted;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }
}
