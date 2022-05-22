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

    public static function formattedForUI( $frequencyCount, $frequencyLatest ) {
        $frequencyFormatted = "No Visits";

        if( $frequencyCount > 0 ) {
            $today = new DateTime();
            $latestDay = DateTime::createFromFormat('Y-m-d', $frequencyLatest);
            $dateDifference = $today->diff( $latestDay );
            $daysAgo = $dateDifference->format('%a');

            $daysAgoFormatted = "TODAY";

            if( $daysAgo > 0 ) {
                $daysAgoFormatted = $daysAgo . " days ago";
            }

            $frequencyFormatted = "Last Visit: $daysAgoFormatted ($frequencyCount total)";
        }
        return $frequencyFormatted;
    }
}