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

    public static function findByName( $name ) {
        $statement = Database::connect()->prepare( "SELECT d.DistanceID, d.Name, d.Position, d.IconFileName FROM Distance d WHERE d.Name = :name" );
        $statement->bindValue( ":name", $name );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, DistanceDAO::class);

        if( count( $results ) > 0 ) {
            return $results[0];
        } else {
            return null;
        }
    }
}