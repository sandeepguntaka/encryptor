<?php

namespace App;

use ReflectionClass;

class Cipher implements CipherInterface
{
    private $provider;

    public static function createInstance($provider = null, $options = [])
    {
        if(is_null($provider)) {
            //Fall back to a default provider is class doesnot exist.
            $provider = '\App\Provider\OpenSslProvider';
        }
        if (!class_exists($provider)) {
            throw new \Exception("Class Not Found");
        }

        // Create an instance of teh provider.
        return call_user_func_array(
            array(
            new ReflectionClass($provider), 'newInstance'
            ),
            $options
        );
    }
    public function __construct($providerClass = null, $options)
    {
        $this->provider = self::createInstance($providerClass, $options);
    }

    public function encrypt(string $text)
    {
        return $this->provider->encrypt($text);
    }

    public function decrypt(string $hash)
    {
        return $this->provider->decrypt($hash);
    }

    public function setProviderProperty($name, $value)
    {
        $this->provider->$name = $value;
    }
    public function getProviderProperty($name)
    {
        return $this->provider->$name;
    }
}
