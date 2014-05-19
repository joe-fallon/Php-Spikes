<pre>
<?php
require_once('InputNodeInterface.php');
require_once('OutputNodeInterface.php');
require_once('InputNode.php');
require_once('RepeaterNode.php');
require_once('DisplayNode.php');

$displayNode  = new DisplayNode();
$repeaterNode = new RepeaterNode($displayNode);
$inputNode    = new InputNode($repeaterNode);

$inputNode->inputData(5);
