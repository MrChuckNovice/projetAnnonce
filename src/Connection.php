<?php
namespace App;

 use PDO; 

class Connection extends PDO {

    public static function getPDO (): PDO {
        return new PDO('mysql:host=localhost;dbname=arcade;charset=utf8','root','', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
}