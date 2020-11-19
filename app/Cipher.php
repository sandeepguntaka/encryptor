<?php

namespace App;

use ReflectionClass;

class Cipher implements CipherInterface
{
    private $provider;

    public static function createInstance(string $provider = null, array $options = [])
    {
        if(is_null($provider)) {
            //Fall back to a default provider if class doesnot exist.
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
    public function __construct(string $providerClass = null, array $options)
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

    public function setProviderProperty(string $name, string $value)
    {
        $this->provider->$name = $value;
    }
    public function getProviderProperty(string $name)
    {
        return $this->provider->$name;
    }
}
