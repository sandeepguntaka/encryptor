<?php

use App\Cipher;

require_once('vendor/autoload.php');

try {

  $cipher = Cipher::createInstance();
  // $cipher = Cipher::createInstance('App\Provider\SodiumProvider');
  $encrypted = $cipher->encrypt("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s");
  var_dump($encrypted);

  // $cipher = Cipher::createInstance('App\Provider\SodiumProvider', [$secretKey]);
  $decrypted = $cipher->decrypt($encrypted);
  var_dump($decrypted);
} catch (Exception $ex) {
  echo $ex->getMessage();
}
die;
