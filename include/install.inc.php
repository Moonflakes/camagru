<?php
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "mthiery";
$dbName = "loginsystem";

if ($con1 = mysqli_connect($dbServerName, $dbUsername, $dbPassword))
{

	$sql = "CREATE DATABASE IF NOT EXISTS loginsystem";
	mysqli_query($con1, $sql);
	
	$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
	$sql = 'CREATE TABLE IF NOT EXISTS users (
  			user_id int(11) not null PRIMARY kEY AUTO_INCREMENT,
  			user_first varchar(256) not null,
  			user_last varchar(256) not null,
  			user_email varchar(256) not null,
  			user_uid varchar(256) not null,
  			user_pwd varchar(512) not null,
  			user_admin int(1) not null
  	);';
  	mysqli_query($conn, $sql);

  $sql = 'CREATE TABLE IF NOT EXISTS products (
        product_id int(11) not null PRIMARY kEY AUTO_INCREMENT,
        product_name varchar(256) not null,
        product_price int(8) not null,
        product_stock int(8) not null,
        product_photo varchar(256) not null,
        product_text varchar(256) not null
    );';
  mysqli_query($conn, $sql);

  $sql = 'CREATE TABLE IF NOT EXISTS categories (
        category_name varchar(256) not null PRIMARY kEY,
    );';
  mysqli_query($conn, $sql);

/*  $sql = 'CREATE TABLE IF NOT EXISTS orders (
        order_id int(11) not null PRIMARY kEY AUTO_INCREMENT,
        product_name varchar(256) not null,
        product_price int(8) not null,
        product_stock int(8) not null,
        product_photo varchar(256) not null,
        order_ok int(1) not null
    );';
  mysqli_query($conn, $sql);
*/
}
else
	echo "Connection failed.";
?>