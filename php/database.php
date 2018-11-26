<?php
//localhost
$host = "locahost;";
$dbname = "loi;";
$dsn = "mysql:host=localhost;dbname=book_share;";
$uname = "root";
$password = "";

//ftp
//$dsn = "mysql:mysql02host.comp.dkit.ie;dbname=D00006968;";
//$uname = "D00006968";
//$password = "QutVu1xa";

try {
    $db = new PDO($dsn , $uname , $password);
    $db ->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
} catch (PDOException $e) {
    $erroe_message = $e ->getMessage();
    include("database_error.php");
    exit();
}

















