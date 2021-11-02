<?php

include_once "database.php";

class LocationDAO {
    public $LocationID;
    public $Name;
    public $Description;
    public $Punchline;
    public $Abbreviation;
    public $Distance;
    public $Cost;
    public $DistanceName;
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

    public $DeathDate;
    public $FoodType;
    public $TravelTime;
    public $HasWifi;
    public $HasCashOnly;
    public $ParkingType;
    public $WaitTime;
    public $Quadrant;


    public static function create($name, $categoryID, $description, $punchline, $abbreviation, $distanceID, $cost, $latitude, $longitude, $menu, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout,
                                    $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant) {
        $deathDate = $deathDate == "" ? null : $deathDate;

        try {
            $statement = Database::connect()->prepare( "INSERT IGNORE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, DistanceID = :distanceID, Latitude = :latitude, Longitude = :longitude, MenuFileName = :menu, HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
                "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout, DeathDate = :deathDate, FoodType = :foodType, TravelTime = :travelTime," .
                "HasWifi = :hasWifi, HasCashOnly = :hasCashOnly, ParkingType = :parkingType, WaitTime = :waitTime, Quadrant = :quadrant, Cost = :cost" );
            $statement->bindValue( ":name", $name );
            $statement->bindValue( ":categoryID", $categoryID );
            $statement->bindValue( ":description", $description );
            $statement->bindValue( ":punchline", $punchline );
            $statement->bindValue( ":abbreviation", $abbreviation );
            $statement->bindValue( ":distanceID", $distanceID );
            $statement->bindValue( ":latitude", $latitude );
            $statement->bindValue( ":longitude", $longitude );
            $statement->bindValue( ":menu", $menu );
            $statement->bindValue( ":hasVegan", $hasVegan, PDO::PARAM_BOOL );
            $statement->bindValue( ":hasVegetarian", $hasVegetarian, PDO::PARAM_BOOL ) ;
            $statement->bindValue( ":hasGlutenFree", $hasGlutenFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasLactoseFree", $hasLactoseFree, PDO::PARAM_BOOL  );
            $statement->bindValue( ":hasTakeout", $hasTakeout, PDO::PARAM_BOOL );
            $statement->bindValue( ":deathDate", $deathDate );
            $statement->bindValue( ":foodType", $foodType);
            $statement->bindValue( ":travelTime", $travelTime);
            $statement->bindValue( ":hasWifi", $hasWifi, PDO::PARAM_BOOL );
            $statement->bindValue( ":hasCashOnly", $hasCashOnly, PDO::PARAM_BOOL );
            $statement->bindValue( ":parkingType", $parkingType);
            $statement->bindValue( ":waitTime", $waitTime);
            $statement->bindValue( ":quadrant", $quadrant);
            $statement->bindValue( ":cost", $cost);
            $statement->execute();
        } catch (PDOException $pe) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo( "Issue occurred adding LOCATION:<br><br>" . $pe->getMessage());
            echo "</div>";
        }
    }

    public static function update($locationID, $name, $categoryID, $description, $punchline, $abbreviation, $distanceID, $cost, $latitude, $longitude, $menuFileName, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout,
                                $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant) {
        $isUpdateMenu = $menuFileName != "";
        $deathDate = $deathDate == "" ? null : $deathDate;

        try {
            $statement = Database::connect()->prepare("UPDATE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, DistanceID = :distanceID, Latitude = :latitude, Longitude = :longitude, " . ( $isUpdateMenu ? "MenuFileName = :menuFileName," : "" ) . "HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
            "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout, DeathDate = :deathDate, FoodType = :foodType, TravelTime = :travelTime," .
                "HasWifi = :hasWifi, HasCashOnly = :hasCashOnly, ParkingType = :parkingType, WaitTime = :waitTime, Quadrant = :quadrant, Cost = :cost WHERE LocationID = :locationID");
            $statement->bindValue( ":name", $name);
            $statement->bindValue( ":categoryID", $categoryID);
            $statement->bindValue( ":description", $description);
            $statement->bindValue( ":punchline", $punchline);
            $statement->bindValue( ":abbreviation", $abbreviation);
            $statement->bindValue( ":distanceID", $distanceID);
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

            $statement->bindValue( ":deathDate", $deathDate );
            $statement->bindValue( ":foodType", $foodType);
            $statement->bindValue( ":travelTime", $travelTime);
            $statement->bindValue( ":hasWifi", $hasWifi, PDO::PARAM_BOOL );
            $statement->bindValue( ":hasCashOnly", $hasCashOnly, PDO::PARAM_BOOL );
            $statement->bindValue( ":parkingType", $parkingType);
            $statement->bindValue( ":waitTime", $waitTime);
            $statement->bindValue( ":quadrant", $quadrant);
            $statement->bindValue( ":cost", $cost);
            $statement->execute();
        } catch (PDOException $pe) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo( "Issue occurred updating LOCATION:<br><br>" . $pe->getMessage());
            echo "</div>";
        }
    }

    public static function getAll() {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString() );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getWithCategoryID( $categoryID ) {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString() . " WHERE l.CategoryID = :categoryID" );
        $statement->bindValue( ":categoryID", $categoryID);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getWithID( $locationID ) {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString() . " WHERE l.LocationID = :locationID" );
        $statement->bindValue( ":locationID", $locationID);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);

        if( count( $results ) > 0 ) {
            return $results[0];
        } else {
            return null;
        }
    }

    public static function getSelectString() {
        return "SELECT l.LocationID, l.Name, l.Description, l.Punchline, l.Abbreviation, " .
            "l.Latitude, l.Longitude, l.MenuFileName, l.Frequency, l.HasVegan, l.HasVegetarian, l.HasGlutenFree, l.HasLactoseFree, l.HasTakeout, " .
            "l.DeathDate, l.FoodType, l.TravelTime, l.HasWifi, l.HasCashOnly, l.ParkingType, l.WaitTime, l.Quadrant, l.Cost, " .
            "(SELECT COUNT(*) FROM Frequency f where f.LocationID = l.LocationID) as Frequency, " .
            "l.CategoryID, c.Name as CategoryName, " .
            "l.DistanceID, d.Name as DistanceName " .
            "FROM Location l JOIN Distance d ON l.DistanceID = d.DistanceID JOIN Category c ON l.CategoryID = c.CategoryID";
    }
}