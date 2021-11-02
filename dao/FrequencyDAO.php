<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 002, 11/2/2021
 * Time: 3:38 PM
 */

class FrequencyDAO {
    public static function insert( $locationID ) {
        $db = Database::connect();
        $statement = $db->prepare( "INSERT INTO Frequency SET LocationID = :locationID, DateVisited = now()" );
        $statement->bindValue( ":locationID", $locationID );
        $statement->execute();
        return "Success";
    }
}