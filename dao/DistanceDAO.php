<?php

include_once "database.php";

class DistanceDAO {
    public $DistanceID;
    public $Name;
    public $Position;
    public $IconFileName;

    public static function getAll() {
        $statement = Database::connect()->prepare( "SELECT d.DistanceID, d.Name, d.Position, d.IconFileName FROM Distance d ORDER BY d.Position" );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, DistanceDAO::class);
        return $results;
    }
}