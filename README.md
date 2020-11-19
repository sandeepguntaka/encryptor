# encryptor

$cipher = \App\Cipher::createInstance('App\Provider\SodiumProvider');

$encrypted = $cipher->encrypt("Lorem Ipsum");

$decrypted = $cipher->decrypt($encrypted);
