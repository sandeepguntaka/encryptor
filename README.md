# encryptor

composer dump-autoload #to generate autoload files

$cipher = \App\Cipher::createInstance('App\Provider\SodiumProvider');

$encrypted = $cipher->encrypt("Lorem Ipsum");

$decrypted = $cipher->decrypt($encrypted);
