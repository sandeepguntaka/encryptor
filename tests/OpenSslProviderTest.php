<?php

use App\Provider\OpenSslProvider;
use PHPUnit\Framework\TestCase;

final class OpenSslProviderTest extends TestCase {
  public function testInitialize() {
    $cipher = new OpenSslProvider();
    $this->assertInstanceof('App\CipherInterface', $cipher);
    $cipher = new OpenSslProvider('1234567890', 'aes-256-ecb');
    $this->assertInstanceof('App\CipherInterface', $cipher);
  }

  public function testEncryptDecrypt() {
    $cipher = new OpenSslProvider('1234567890', 'aes-256-ecb');
    $string = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s";
    $encrypted = $cipher->encrypt($string);
    $this->assertIsString($encrypted);
    $this->assertNotEquals($encrypted, $string);

    $decrypted = $cipher->decrypt($encrypted);
    $this->assertNotEquals($encrypted, $decrypted);
    $this->assertEquals($decrypted, $string);
  }
}
