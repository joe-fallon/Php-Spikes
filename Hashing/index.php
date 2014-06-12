<pre>
<?php
$example_password = "billybob";
echo '$example_password = ' . $example_password . "\n";
$microtime = microtime(true);
echo '$microtime = ' . $microtime . "\n";
$random = mt_rand();
echo '$random = ' . $random . "\n";
$key = '!@#$%^&*()_+=-{}][;";/?<>.,';
echo '$key = ' . $key . "\n";
$salt_seed = $random . $key . $microtime;
echo '$salt_seed = ' . $salt_seed . "\n";
$salt = hash('md5', $salt_seed);
echo '$salt   = ' . $salt . "\n";
$sha1   = hash('sha1', $salt . $example_password);
echo '$sha1   = ' . $sha1 . "\n";
$sha256 = hash('sha256', $salt . $example_password);
echo '$sha256 = ' . $sha256 . "\n";
$sha384 = hash('sha384', $salt . $example_password);
echo '$sha384 = ' . $sha384 . "\n";
$sha512 = hash('sha512', $salt . $example_password);
echo '$sha512 = ' . $sha512 . "\n";
?>

aaaf234dce48f4cf1995106a12815f16         <-- md5 = 32 bytes
20056e2f3df82c3894897fcc5be35e116b2faebe <-- sha1 = 40 bytes


Hashing Speed Tests
-------------------

<?php

$string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin commodo dui eu dolor varius in feugiat turpis placerat. Cras sem neque, volutpat egestas tempor non, accumsan in neque. Suspendisse cursus, massa in pretium rutrum, enim turpis varius nunc, non vestibulum quam nisl ut velit. Phasellus luctus pretium ultrices. Nulla ac convallis dui. Nulla fermentum magna id nunc eleifend ut pharetra magna varius. Mauris ac felis dolor. Vestibulum orci neque, sagittis id varius nec, porttitor ut quam. Donec placerat quam quis urna tincidunt eu consectetur odio mattis. Duis a egestas lacus. Nam a libero sed leo tempor faucibus sit amet in enim. Suspendisse condimentum porttitor augue, et tempor mauris consectetur vel. Pellentesque et arcu non nulla ultricies volutpat ac volutpat arcu. Vestibulum mattis felis a justo dictum consequat. Donec justo purus, cursus ac malesuada consequat, mattis eu ipsum. Sed sit amet tortor dui, ac commodo felis. Nullam aliquet ante et libero mollis volutpat. Nullam neque libero, posuere vitae ullamcorper a, lobortis a arcu. Maecenas ac sem augue, a accumsan massa.\n"
.
"Sed auctor lacinia aliquet. Nam fringilla augue eget arcu eleifend condimentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas accumsan odio ac quam mollis mattis. Donec non ligula neque, ut consectetur metus. Nulla tempor dapibus purus at luctus. Curabitur feugiat, justo quis adipiscing dictum, sapien felis tristique lectus, at blandit quam eros at est. Suspendisse potenti. Nunc eu neque a velit congue mollis quis ac elit. Quisque justo enim, accumsan eget dignissim mattis, iaculis quis lectus. Praesent sit amet libero est, ac tempor lectus. Cras condimentum accumsan ante et luctus.\n"
.
"Morbi fringilla tortor ac neque rhoncus rutrum. Morbi laoreet suscipit bibendum. Proin at tortor vitae arcu sodales venenatis. Mauris viverra, enim vel cursus placerat, lorem lectus varius urna, sit amet faucibus magna leo vel turpis. Quisque elementum diam id sapien elementum laoreet. Aliquam rhoncus urna at nisl elementum pulvinar. Morbi mollis, justo a varius vestibulum, ante lectus placerat sem, nec blandit sem augue ac turpis. Duis convallis bibendum enim in consectetur. Nulla aliquam, purus non rutrum gravida, nisi libero blandit ante, in egestas justo tellus quis elit. Aenean pharetra euismod urna ac tristique. Pellentesque a quam justo. Vestibulum aliquam orci magna. Phasellus arcu augue, lacinia eu pretium in, rhoncus elementum purus.\n"
.
"Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin interdum, magna sed rhoncus faucibus, urna turpis scelerisque orci, hendrerit eleifend nulla diam sed enim. Proin semper venenatis iaculis. Morbi accumsan varius fringilla. Suspendisse consequat metus nec arcu fermentum sodales. Aliquam leo tellus, venenatis a venenatis in, porta sed mauris. Mauris ullamcorper, orci quis iaculis iaculis, orci urna ornare enim, in interdum turpis tellus non ante. Ut at diam sapien, iaculis ultricies ante. Quisque a eros at leo tristique mattis. Ut lectus nulla, fermentum vitae bibendum a, vulputate non ipsum. Nulla a scelerisque orci. Nullam eu erat ipsum, sit amet faucibus massa. Nunc a risus eros. Aliquam porttitor congue faucibus. Donec vitae nisl lorem.\n"
.
"Suspendisse malesuada tempus faucibus. Nullam eget sapien enim. Praesent malesuada mattis malesuada. Phasellus in lorem non tellus porta molestie. Fusce pulvinar sodales libero, eget semper neque cursus vitae. Proin mattis magna felis, non tempus lorem. Nullam quis lorem leo, porttitor tempor dolor. Aliquam justo urna, faucibus sed consectetur sagittis, pulvinar id ante. Proin mollis velit ipsum. Suspendisse iaculis, mi et sollicitudin porttitor, arcu elit rutrum lacus, eu consequat nisl leo vitae quam. Suspendisse aliquet, nibh ac consectetur hendrerit, mi risus pellentesque elit, in molestie felis augue vitae purus. Vestibulum libero augue, tincidunt in accumsan sed, mattis sed magna. Cras sit amet erat eget elit fermentum lacinia. Nulla facilisi.\n"
.
"Donec scelerisque, ligula eget ullamcorper commodo, ligula mi posuere sapien, ac ornare dui urna in eros. Etiam faucibus purus at erat faucibus suscipit. Nulla dapibus mattis diam. Maecenas in ornare ipsum. Fusce tincidunt interdum felis ut rutrum. Nam sagittis malesuada pellentesque. Quisque ac est magna. Quisque felis nunc, accumsan id venenatis id, sollicitudin eget ipsum. Vestibulum sit amet nulla sem, ut ultricies tellus. Suspendisse rhoncus iaculis dui, non facilisis justo tristique non. Cras fermentum pulvinar venenatis. Vivamus id orci mi, ac suscipit massa. Nulla est quam, tristique a adipiscing facilisis, lacinia quis sapien. Etiam aliquam pretium dictum. Nulla facilisi. Mauris venenatis rhoncus pretium.\n"
.
"Curabitur enim elit, egestas ut luctus eget, mattis ac erat. Cras ultrices ipsum nec felis blandit vitae semper augue iaculis. Curabitur nibh tellus, semper eu cursus quis, hendrerit quis risus. Aenean tempor feugiat mi vel consequat. Maecenas fermentum varius viverra. Nunc mattis lacus tortor. Vestibulum quam erat, consequat non sodales eget, mattis porta diam. In elit lorem, sollicitudin non varius sit amet, feugiat at massa. Sed orci augue, varius ac tempus sit amet, luctus placerat ligula. Praesent rhoncus congue vehicula. Pellentesque tellus tortor, vehicula quis gravida id, vestibulum id magna. Integer venenatis nibh eget sem sollicitudin eu varius tellus cursus. Nam ornare tempus magna eu sollicitudin. Aliquam erat volutpat. Donec malesuada nisi ut ipsum pulvinar at molestie mauris condimentum. Nullam id lacus libero, placerat convallis nunc. Curabitur feugiat est vel ante commodo vulputate.\n"
.
"Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus ultrices pellentesque nisl in bibendum. Nullam quam nisl, dapibus non malesuada id, mattis ac eros. Nulla et sem purus. Praesent auctor aliquet neque, quis viverra augue ullamcorper vel. Nunc et urna rutrum turpis lobortis pretium ut sit amet magna. Nunc interdum consectetur gravida. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur fringilla, neque at blandit ornare, lectus mi egestas nulla, quis hendrerit ante tellus in lectus. Nunc sed risus sit amet velit tempus lobortis sit amet vel dolor. Proin sit amet libero erat. Suspendisse eget massa quis magna dictum cursus at non ipsum. Integer pharetra, enim elementum lacinia interdum, est urna vestibulum massa, at aliquam risus nisi eu sem.\n"
.
"Integer vulputate diam eget orci condimentum commodo. Aliquam erat volutpat. Nulla diam odio, cursus in dictum a, vestibulum id velit. Donec fringilla scelerisque porttitor. Aenean a diam vitae tortor viverra tempus. Maecenas vehicula mattis sagittis. Quisque eget turpis a sapien venenatis varius. Maecenas id vestibulum sapien. Suspendisse potenti. Nam nisl tortor, semper sodales convallis ut, mattis vel dolor. Ut ut dolor quis augue porttitor vulputate a non ante. Proin rutrum sodales tempor. In posuere pulvinar risus aliquam fermentum.\n"
.
"Phasellus ac ante elit. Morbi fermentum interdum laoreet. Nulla volutpat augue sit amet est aliquam pulvinar. Aliquam sed mi lorem, id rutrum orci. Maecenas accumsan est consequat lorem luctus at ullamcorper libero sagittis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum aliquet semper urna, quis fringilla ante blandit vel. Nam vestibulum quam et sapien tempor feugiat posuere leo blandit. Cras ut aliquam lectus. Donec gravida commodo varius. Sed accumsan luctus quam, non aliquam sem consequat in. Nam a tempus ipsum. Sed quis neque lacus. Mauris tristique mauris in ipsum porttitor fermentum. In hac habitasse platea dictumst. Fusce faucibus suscipit elementum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In hac habitasse platea dictumst.\n"
.
"Curabitur mollis pretium posuere. Suspendisse nec purus porta dui mattis congue. In hac habitasse platea dictumst. Vivamus sollicitudin arcu vitae magna ultricies volutpat. Ut auctor nibh at odio rutrum sit amet vulputate dui congue. Fusce nulla magna, aliquet vel iaculis non, imperdiet non justo. In varius tincidunt condimentum. Aliquam sed est elit. Integer ullamcorper felis tortor, quis cursus est. Nulla dolor turpis, tristique at adipiscing nec, molestie sollicitudin tellus. Aenean quis erat erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum erat mi, semper ac tempus vel, aliquet eget lacus. Integer adipiscing, ipsum vitae volutpat porttitor, turpis metus eleifend tellus, nec viverra nunc lectus id metus. Ut porttitor porta nunc. Aenean nulla urna, fringilla in condimentum ut, fermentum ut eros. Duis id neque nec est feugiat placerat eget nec leo. Sed consectetur est et leo blandit elementum. Maecenas dapibus velit et urna volutpat quis tincidunt libero tincidunt.\n"
.
"In dui tortor, dignissim in elementum et, dapibus id mauris. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam erat volutpat. Donec ut libero arcu. Etiam mollis elementum tortor at euismod. Vestibulum urna mauris, pretium eget dapibus nec, sodales in sem. Donec dignissim vehicula risus, in consectetur purus accumsan vel. Aliquam consectetur porta vehicula. Mauris ac augue sem, imperdiet auctor est. Phasellus malesuada suscipit aliquam.\n"
.
"Nulla eget cursus quam. Duis commodo elit at erat viverra et sodales libero commodo. Aliquam luctus diam id sapien bibendum dignissim. Morbi vitae neque leo, sed congue risus. Morbi ac odio enim, quis facilisis tortor. Fusce interdum auctor bibendum. Vestibulum et quam at eros posuere malesuada et nec quam. Aenean lacinia diam quis justo tempus eu rutrum nunc ultricies. Aliquam eu commodo diam. Maecenas ac rhoncus arcu. Sed urna justo, semper et dapibus sed, bibendum nec nibh. Aenean quam neque, posuere at viverra in, pellentesque et ante.\n"
.
"Nunc vehicula risus elementum leo tincidunt egestas. Suspendisse ipsum velit, laoreet lacinia auctor et, sagittis vitae lacus. Vivamus ut mattis enim. Maecenas ut metus eu neque bibendum semper non ac sapien. Praesent suscipit, nulla non sagittis semper, lacus est aliquet lacus, eu pharetra turpis risus a sem. Vestibulum nunc libero, sodales ac vehicula at, pharetra eget eros. Proin varius ultricies tincidunt. Sed nec diam mauris, sit amet tempus augue. Pellentesque bibendum semper mollis. Ut aliquet lectus non lacus varius malesuada. Phasellus quam metus, hendrerit ut mattis vitae, faucibus eu mi.\n";

echo 'Hashing Using crc32 1000x: ';
$start      = microtime(true);

$hash = '';

for($i = 0; $i < 1000; $i++)
{
    $hash = crc32($string);
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";

echo 'Hashing Using md5 1000x: ';
$start      = microtime(true);

$hash = '';

for($i = 0; $i < 1000; $i++)
{
    $hash = md5($string);
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";

echo 'Hashing Using sha1 1000x: ';
$start      = microtime(true);

$hash = '';

for($i = 0; $i < 1000; $i++)
{
    $hash = sha1($string);
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";

echo 'Hashing Using sha256 1000x: ';
$start      = microtime(true);

$hash = '';

for($i = 0; $i < 1000; $i++)
{
    $hash = hash('sha256', $string);
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";

echo 'Hashing Using sha512 1000x: ';
$start      = microtime(true);

$hash = '';

for($i = 0; $i < 1000; $i++)
{
    $hash = hash('sha512', $string);
}

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo 'hash = ' . $hash . "\n\n";







echo 'Create salt using mcrypt_create_iv(22, MCRYPT_DEV_URANDOM): ';
$start      = microtime(true);

$salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
$salt = base64_encode($salt);
$salt = str_replace('+', '.', $salt);

//$salt = 'abcdefghijklmnopqrstuvwxyz123456';

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo '$salt = ' . $salt . "\n\n";






echo 'Create hash using crypt(rasmuslerdorf, $2y$10$.$salt.$): ';
$start      = microtime(true);

$hash = crypt('rasmuslerdorf', '$2y$10$'.$salt.'$');

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo '$hash = ' . $hash . "\n\n";





echo 'Create hash using crypt(rasmuslerdorf, $hash): ';
$start      = microtime(true);

$hash = crypt('rasmuslerdorf', $hash);

$stop       = microtime(true);
$elapsed    = ($stop - $start) * 1000;
echo sprintf("%01.2f", $elapsed) . "mSecs\n";
echo '$hash = ' . $hash . "\n\n";









?>

</pre>


