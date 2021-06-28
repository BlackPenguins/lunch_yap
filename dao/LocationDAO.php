<?php

include_once "database.php";

class LocationDAO {
    public $LocationID;
    public $Name;
    public $Description;
    public $Punchline;
    public $Abbreviation;
    public $Distance;
    public $Latitude;
    public $Longitude;
    public $MenuFileName;
    public $Frequency;
    public $HasVegan;
    public $HasVegetarian;
    public $HasGlutenFree;
    public $HasLactoseFree;
    public $HasTakeout;
    public $CategoryID;
    public $CategoryName;

    public static function create( $name, $categoryID, $description, $punchline, $abbreviation, $distance, $latitude, $longitude, $menu, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout ) {
        try {
            $statement = Database::connect()->prepare( "INSERT IGNORE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, Distance = :distance, Latitude = :latitude, Longitude = :longitude, MenuFileName = :menu, HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
                "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout" );
            $statement->bindValue( ":name", $name );
            $statement->bindValue( ":categoryID", $categoryID );
            $statement->bindValue( ":description", $description );
            $statement->bindValue( ":punchline", $punchline );
            $statement->bindValue( ":abbreviation", $abbreviation );
            $statement->bindValue( ":distance", $distance );
            $statement->bindValue( ":latitude", $latitude );
            $statement->bindValue( ":longitude", $longitude );
            $statement->bindValue( ":menu", $menu );
            $statement->bindValue( ":hasVegan", $hasVegan, PDO::PARAM_BOOL );
            $statement->bindValue( ":hasVegetarian", $hasVegetarian, PDO::PARAM_BOOL ) ;
            $statement->bindValue( ":hasGlutenFree", $hasGlutenFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasLactoseFree", $hasLactoseFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasTakeout", $hasTakeout, PDO::PARAM_BOOL  );
            $statement->execute();
        } catch (PDOException $pe) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo( "Issue occurred adding LOCATION:<br><br>" . $pe->getMessage());
            echo "</div>";
        }
    }

    public static function update($locationID, $name, $categoryID, $description, $punchline, $abbreviation, $distance, $latitude, $longitude, $menuFileName, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout  ) {
        $isUpdateMenu = $menuFileName != "";

        try {
            $statement = Database::connect()->prepare("UPDATE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, Distance = :distance, Latitude = :latitude, Longitude = :longitude, " . ( $isUpdateMenu ? "MenuFileName = :menuFileName," : "" ) . "HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
            "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout WHERE LocationID = :locationID");
            $statement->bindValue( ":name", $name);
            $statement->bindValue( ":categoryID", $categoryID);
            $statement->bindValue( ":description", $description);
            $statement->bindValue( ":punchline", $punchline);
            $statement->bindValue( ":abbreviation", $abbreviation);
            $statement->bindValue( ":distance", $distance);
            $statement->bindValue( ":latitude", $latitude);
            $statement->bindValue( ":longitude", $longitude);
            if( $isUpdateMenu ) {
                $statement->bindValue(":menuFileName", $menuFileName);
            }
            $statement->bindValue( ":hasVegan", $hasVegan, PDO::PARAM_BOOL );
            $statement->bindValue( ":hasVegetarian", $hasVegetarian, PDO::PARAM_BOOL ) ;
            $statement->bindValue( ":hasGlutenFree", $hasGlutenFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasLactoseFree", $hasLactoseFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasTakeout", $hasTakeout, PDO::PARAM_BOOL  );
            $statement->bindValue( ":locationID", $locationID);
            $statement->execute();
        } catch (PDOException $pe) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo( "Issue occurred updating LOCATION:<br><br>" . $pe->getMessage());
            echo "</div>";
        }
    }

    public static function getAll() {
        $statement = Database::connect()->prepare( "SELECT l.LocationID, l.Name, l.Description, l.Punchline, l.Abbreviation, l.Distance, " .
            "l.Latitude, l.Longitude, l.MenuFileName, l.Frequency, l.HasVegan, l.HasVegetarian, l.HasGlutenFree, l.HasLactoseFree, l.HasTakeout, " .
            "l.CategoryID, c.Name as CategoryName FROM Location l JOIn Category c ON l.CategoryID = c.CategoryID" );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getWithCategoryID( $categoryID ) {
        $statement = Database::connect()->prepare( "SELECT l.LocationID, l.Name, l.Description, l.Punchline, l.Abbreviation, l.Distance, " .
            "l.Latitude, l.Longitude, l.MenuFileName, l.Frequency, l.HasVegan, l.HasVegetarian, l.HasGlutenFree, l.HasLactoseFree, l.HasTakeout, " .
            "l.CategoryID, c.Name as CategoryName FROM Location l JOIn Category c ON l.CategoryID = c.CategoryID WHERE l.CategoryID = :categoryID" );
        $statement->bindValue( ":categoryID", $categoryID);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }
}