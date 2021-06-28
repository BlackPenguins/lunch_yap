<?php

include_once "database.php";

class CategoryDAO {
    public $CategoryID;
    public $Name;
    public $Position;

    public static function create( $name, $position ) {
        $db = Database::connect();
        $statement = $db->prepare( "INSERT IGNORE Category SET Name = :name, Position = :position" );
        $statement->bindValue( ":name", $name );
        $statement->bindValue( ":position", $position );
        $statement->execute();
        return $db->lastInsertId();
    }

    public static function update( $categoryID, $name, $position ) {
        $statement = Database::connect()->prepare( "UPDATE Category SET Name = :name, Position = :position WHERE CategoryID = :categoryID" );
        $statement->bindValue( ":name", $name );
        $statement->bindValue( ":position", $position );
        $statement->bindValue( ":categoryID", $categoryID );
        $statement->execute();
    }

    public static function getAll() {
        $statement = Database::connect()->prepare( "SELECT c.CategoryID, c.Name, c.Position FROM Category c ORDER BY c.Position" );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, CategoryDAO::class);
        return $results;
    }
}