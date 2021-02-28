<?php

/**
  * Configuration for database initialization and connection
  *
  */

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "test"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );