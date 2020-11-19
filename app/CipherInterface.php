<?php namespace App;


interface CipherInterface
{

    public function encrypt(string $text);
    public function decrypt(string $text);
}
