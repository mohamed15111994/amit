<?php
$dsn='mysql:host=localhost;dbname=amit';
$user='root';
$pass='';
try{
    $con=new PDO($dsn ,$user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    // echo 'connect';
}catch (PDOException $e){
    echo 'faild to connect'. $e->getMessage();
}