<?php

try {
	$pdo = new PDO('mysql:dbname=db name; host=localhost', 'username', 'password');
} catch (PDOException $e) {
	die($e->getMessage());
}