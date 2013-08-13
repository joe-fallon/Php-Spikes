<?php

define('DB_NAME', 'spike_redbean');
define('DB_USER', 'spike_redbean');
define('DB_PASS', 'spike_redbean');
define('DB_HOST', 'localhost');

$dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;

//First, we need to include redbean
require_once('rb.php');

//Second, we need to setup the database

R::setup($dsn, DB_USER, DB_PASS);
R::nuke();


require_once('ActiveBean.php');
require_once('Bug.php');
require_once('Product.php');
require_once('User.php');