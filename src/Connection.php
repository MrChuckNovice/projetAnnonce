<?php
namespace App;

 use PDO; 

class Connection extends PDO {

    public static function getPDO (): PDO {
        return new PDO('mysql:host=localhost;dbname=arcade;charset=utf8','root','', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public static function create(string $table, array $data) {

        $bdd = self::getPDO();

        //On veux construire la requete sous la forme INSERT INTO $table($data.keys) VALUES(?)
        $req = "INSERT INTO" . $table;
        $req .= " ('".implode("','", array_keys($data))."')";
        $req .= " VALUES (:".implode(", :", array_keys($data)).") ";
        $response = $bdd->prepare($req);
        $response->execute($data);
        return $bdd->lastInsertId();
    }

    public static function delete(string $table, array $data) {

        $bdd = self::getPDO();

        $req = "DELETE FROM " . $table . "WHERE " . array_keys($data)[0] . "= :" . array_keys($data)[0];

        $response = $bdd->prepare($req);

        $response->execute($data);

        return;
    }

    public static function update(string $table, array $data, string $idField = null ) {
        
        $bdd = self::getPDO();
        
        $req = "UPDATE " . $table . " SET ";

        $whereIdString = '';

        $whereIdString = ($idField = null) ? "WHERE '" . $idField . "' = :" . $idField : " WHERE id = :id";

        foreach($data as $key => $value) {
            if ($key !== 'id') {
                $req .= "'" . "' = :" . $key . ", ";
            }

        }

        $req = substr($req, 0, -2);
        $req .= $whereIdString;

        $response = $bdd->prepare($req);

        $response->execute($data);
        return $bdd->lastInsertId();
    }
}