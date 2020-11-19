<?php

use App\Cipher;
use App\CipherInterface;
use PHPUnit\Framework\TestCase;

final class CipherTest extends TestCase{
  public function testInitialize(){
    $cipher = Cipher::createInstance();
    $this->assertInstanceof('App\CipherInterface', $cipher);
    // $cipher = Cipher::createInstance('dsadsa', ['ds']);
    // $this->assertInstanceof('Exception', $cipher);
    $cipher = Cipher::createInstance('App\Provider\SodiumProvider',[]);
    $this->assertInstanceof('App\CipherInterface', $cipher);
    
  }

  public function testEncryptDecrypt(){
    $cipher = Cipher::createInstance();
    $string = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
    $encrypted = $cipher->encrypt($string);
    $this->assertIsString($encrypted);
    $this->assertNotEquals($encrypted, $string);

    $decrypted = $cipher->decrypt($encrypted);
    $this->assertNotEquals($encrypted, $decrypted);
    $this->assertEquals($decrypted, $string);
  }

}