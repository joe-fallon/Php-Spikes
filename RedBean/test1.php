<?php
// $date = date('Y-m-d H:i:s');

require_once('config.php');

// Create the persons.
$person1 = R::dispense('person');
$person1->name = 'Joe';
R::store($person1);

$person2 = R::dispense('person');
$person2->name = 'Mary';
R::store($person2);

$person3 = R::dispense('person');
$person3->name = 'Bill';
R::store($person3);


// Create the categories.
$category1 = R::dispense('category');
$category1->name = 'Feature';
R::store($category1);

$category2 = R::dispense('category');
$category2->name = 'Bug';
R::store($category2);

$category3 = R::dispense('category');
$category3->name = 'Research';
R::store($category3);

$task = R::dispense('task');
$task->description = 'Deploy';
$task->category = $category2;

$persons = array();
$persons[] = $person1;
$persons[] = $person2;
$task->sharedAssignedP = $persons;


R::store($task);

