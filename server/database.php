<?php 

$dsn = 'mysql:host=localhost;dbname=CORA';
$username = 'root';
$password = '';

$PDO = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

function make_hash($str){
    return md5($str);
}