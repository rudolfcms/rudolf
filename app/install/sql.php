<?php

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

include './DataGenerator.php';
include './structure.php';

$config = include '../config/database.php';

$dns = $config['engine'] 
	.':dbname='. $config['database'] 
	.';charset='. $config['charset'] 
	.';host='. $config['host'];

$pdo = new PDO($dns, $config['user'], $config['pass']);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

$random = file_get_contents('./random.txt');

$generator = new Rudolf\install\DataGenerator($pdo, $_tables, $_fields, $random);

$posts = 50;
$number = $generator->addRandom($posts, $_tables['albums']);

echo "Successfull added $posts!";
