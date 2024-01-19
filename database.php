<?php

function getDB(){
    $dsn = 'mysql:host=localhost;dbname=fruit_stand';
    $username = 'web_user';
    $password = 'pa55word';

    try{
        $db = new PDO($dsn, $username, $password);
        return $db;
    }catch(PDOException $exception){
        $error_message = $exception ->getMessage();
        include('database_error.php');
        exit();
    }
}
?>