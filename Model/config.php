
<?php
// Base de données et tableau

    $dsn = "mysql:dbname=ipssi;host=127.0.0.1";
    $login = "root";
    $pass = "root";

    try{
        $db = new PDO($dsn,$login,$pass);
    }catch (Exception $e){
        var_dump($e);die;
    }


    ?>