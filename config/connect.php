<?php

$connect = mysqli_connect('localhost', 'root', '', 'world');

if (!$connect) {
	die ('error');
} 

$mysqli = "INSERT INTO Users (name, age) VALUES (1,1)"
?>