
<?php
// Base de données et tableau

    $dsn = "mysql:dbname=ipssi;host=localhost";
    $login = "root";
    $pass = "root";

    try{
        $db = new PDO($dsn,$login,$pass);
    }catch (Exception $e){
        var_dump($e);die;
    }


    ?>