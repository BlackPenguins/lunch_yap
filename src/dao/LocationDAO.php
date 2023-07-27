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
    public $FrequencyLatest;
    public $FrequencyCount;
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
    public $IsPlan;
    public $HasCashOnly;
    public $ParkingType;
    public $WaitTime;
    public $Quadrant;


    public static function create($name, $categoryID, $description, $punchline, $abbreviation, $distanceID, $cost, $latitude, $longitude, $menu, $hasVegan, $hasVegetarian, $hasGlutenFree, $hasLactoseFree, $hasTakeout,
                                    $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant, $isPlan) {
        $deathDate = $deathDate == "" ? null : $deathDate;

        try {
            $statement = Database::connect()->prepare( "INSERT IGNORE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, DistanceID = :distanceID, Latitude = :latitude, Longitude = :longitude, MenuFileName = :menu, HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
                "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout, DeathDate = :deathDate, FoodType = :foodType, TravelTime = :travelTime," .
                "HasWifi = :hasWifi, HasCashOnly = :hasCashOnly, ParkingType = :parkingType, WaitTime = :waitTime, Quadrant = :quadrant, Cost = :cost, IsPlan = :isPlan" );
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
            $statement->bindValue( ":isPlan", $isPlan, PDO::PARAM_BOOL );
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
                                $deathDate, $foodType, $travelTime, $hasWifi, $hasCashOnly, $parkingType, $waitTime, $quadrant, $isPlan) {
        $isUpdateMenu = $menuFileName != "";
        $deathDate = $deathDate == "" ? null : $deathDate;

        try {
            $statement = Database::connect()->prepare("UPDATE Location SET Name = :name, CategoryID = :categoryID, Description = :description, Punchline = :punchline, " .
                "Abbreviation = :abbreviation, DistanceID = :distanceID, Latitude = :latitude, Longitude = :longitude, " . ( $isUpdateMenu ? "MenuFileName = :menuFileName," : "" ) . "HasVegan = :hasVegan, HasVegetarian = :hasVegetarian, " .
            "HasGlutenFree = :hasGlutenFree, HasLactoseFree = :hasLactoseFree, HasTakeout = :hasTakeout, DeathDate = :deathDate, FoodType = :foodType, TravelTime = :travelTime," .
                "HasWifi = :hasWifi, HasCashOnly = :hasCashOnly, ParkingType = :parkingType, WaitTime = :waitTime, Quadrant = :quadrant, Cost = :cost, IsPlan = :isPlan WHERE LocationID = :locationID");
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
            $statement->bindValue( ":isPlan", $isPlan, PDO::PARAM_BOOL  );
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
        $statement = Database::connect()->prepare( LocationDAO::getSelectString( false ) );
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getWithCategoryID( $categoryID ) {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString( false ) . " WHERE l.CategoryID = :categoryID" );
        $statement->bindValue( ":categoryID", $categoryID);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getWithID( $locationID ) {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString( true ) . " WHERE l.LocationID = :locationID" );
        $statement->bindValue( ":locationID", $locationID);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);

        if( count( $results ) > 0 ) {
            return $results[0];
        } else {
            return null;
        }
    }

    public static function getWithName( $locationName ) {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString( false ) . " WHERE l.Name = :locationName" );
        $statement->bindValue( ":locationName", $locationName);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);

        if( count( $results ) > 0 ) {
            return $results[0];
        } else {
            return null;
        }
    }

    public static function getAllByLastVisit() {
        $statement = Database::connect()->prepare( LocationDAO::getSelectString( true ) . " WHERE l.IsPlan = :isPlan GROUP BY l.LocationID ORDER BY FrequencyLatest ASC, l.Name ASC" );
        $statement->bindValue( ":isPlan", true);
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, LocationDAO::class);
        return $results;
    }

    public static function getSelectString( $includeFrequency ) {
        return "SELECT l.LocationID, l.Name, l.Description, l.Punchline, l.Abbreviation, " .
            "l.Latitude, l.Longitude, l.MenuFileName, l.HasVegan, l.HasVegetarian, l.HasGlutenFree, l.HasLactoseFree, l.HasTakeout, " .
            "l.DeathDate, l.FoodType, l.TravelTime, l.HasWifi, l.HasCashOnly, l.ParkingType, l.WaitTime, l.Quadrant, l.Cost, l.IsPlan, " .
            "l.CategoryID, c.Name as CategoryName, " .
            ( $includeFrequency ?
            "MAX(f.dateVisited) as FrequencyLatest, " .
            "COUNT(f.LocationID) as FrequencyCount, " : "" ) .
            "l.DistanceID, d.Name as DistanceName " .
            "FROM Location l " .
            "JOIN distance d ON l.DistanceID = d.DistanceID " .
            "JOIN category c ON l.CategoryID = c.CategoryID " .
            ( $includeFrequency ?
            "LEFT JOIN frequency f ON l.LocationID = f.LocationID" : "" );
    }
}