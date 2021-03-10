<?php

require __DIR__ . '/vendor/autoload.php';

$host       = "";
$username   = "";
$password   = "";
$dbname     = "";
$port       = "";

if (getenv("PRODUCTION")=="true") {
  $host       = getenv("HOST");
  $username   = getenv("USERNAME");
  $password   = getenv("PASSWORD");
  $dbname     = getenv("DBNAME");
  $port       = getenv("DB_PORT");
} else {
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
  $dotenv->load();
  $host       = $_ENV["HOST"];
  $username   = $_ENV["USERNAME"];
  $password   = $_ENV["PASSWORD"];
  $dbname     = $_ENV["DBNAME"];
  $port       = $_ENV["DB_PORT"];
}

$dsn        = "mysql:host=$host;dbname=$dbname;port=$port";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );