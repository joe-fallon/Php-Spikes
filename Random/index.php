<pre>
<?php
$bytes = mcrypt_create_iv(1024, MCRYPT_DEV_URANDOM);
$bytes = base64_encode($bytes);
echo '$bytes   = '.$bytes."\n";
$salt = hash('sha512', $bytes);
$salt = substr($salt, 40, 40);
echo '40 chars = '.'1234567890123456789012345678901234567890123456789012345678901234'."\n";
echo '40 chars = '.'        10        20        30        40        50        60'."\n";
echo '$salt    = '.$salt."\n";

$password = 'mypassword';

$turns = pow(2, 20);

echo "Hashing Using sha512 $turns x: ";
$start      = microtime(true);

$hash = '';

for($i = 0; $i < $turns; $i++)
{
    $hash = hash('sha512', $hash.$salt.$password);
}

$hash = substr($hash, 40, 40);

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";

