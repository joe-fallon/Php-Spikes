<?php
require_once('config.php');

$bug1 = Bug::create();
$bug1->setDescription('This is bug 1.');
$bug1->save();

$bug2 = Bug::create();
$bug2->setDescription('This is bug 2.');
$bug2->save();

$bug3 = Bug::create();
$bug3->setDescription('This is bug 3.');
$bug3->save();

$product1 = Product::create();
$product1->setName('Product 1');
$product1->save();

$product2 = Product::create();
$product2->setName('Product 2');
$product2->save();

$product3 = Product::create();
$product3->setName('Product 3');
$product3->save();

$user1 = User::create();
$user1->setName('User 1');
$user1->save();

$user2 = User::create();
$user2->setName('User 2');
$user2->save();

$user3 = User::create();
$user3->setName('User 3');
$user3->save();


$user1->addReportedBug($bug1);
$user1->addReportedBug($bug2);