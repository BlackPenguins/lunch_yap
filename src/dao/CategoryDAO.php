<?php

include_once "database.php";

class CategoryDAO {
    public $CategoryID;
    public $Name;
    public $Position;
    public $IconFileName;

    public static function create( $name, $position, $iconFileName ) {
        $db = Database::connect();
        $statement = $db->prepare( "INSERT IGNORE Category SET Name = :name, Position = :position, IconFileName = :iconFileName" );
        $statement->bindValue( ":name", $name );
        $statement->bindValue( ":position", $position );
        $statement->bindValue( ":iconFileName", $iconFileName );
        $statement->execute();
        return $db->lastInsertId();
    }

    public static function update( $categoryID, $name, $position, $iconFileName ) {
        $statement = Database::connect()->prepare( "UPDATE Category SET Name = :name, Position = :position, IconFileName = :iconFileName WHERE CategoryID = :categoryID" );
        $statement->bindValue( ":name", $name );
        $statement->bindValue( ":position", $position );
        $statement->bindValue( ":categoryID", $categoryID );
        $statement->bindValue( ":iconFileName", $iconFileName );
        $statement->execute();
    }

    public static function getAll() {
        $statement = Database::connect()->prepare( "SELECT c.CategoryID, c.Name, c.Position, c.IconFileName FROM category c ORDER BY c.Position" );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, CategoryDAO::class);
        return $results;
    }

    public static function findByName( $name ) {
        $statement = Database::connect()->prepare( "SELECT c.CategoryID, c.Name, c.Position, c.IconFileName FROM category c WHERE c.Name = :name" );
        $statement->bindValue( ":name", $name );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, CategoryDAO::class);

        if( count( $results ) > 0 ) {
            return $results[0];
        } else {
            return null;
        }
    }
}