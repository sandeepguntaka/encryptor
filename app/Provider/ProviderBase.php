<?php
/**
 * @file
 * Base Class for providers to extend from.
 */
namespace App\Provider;

use App\CipherInterface;

/**
 * Class ProviderBase
 */
abstract class ProviderBase implements CipherInterface
{
    public function __set($name, $val)
    {
        $this->$name = $val;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}