<?php

define('DBHOST', "localhost");
define('DBNAME', "traveler");
define('DBUSER', "root");
define('DBPASS', "root");

try {
    $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME . "", DBUSER, DBPASS);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to DB".$e->getMessage());
}
