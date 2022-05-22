<?php
    include_once "database.php";
    include_once "dao/LocationDAO.php";
    include_once "dao/FrequencyDAO.php";

    $quadrant = $_GET['quadrant'];
    $searchType = $_GET['search'];

    if( $searchType == "last_visit" ) {
        $lunchSpots = array();

        foreach (LocationDAO::getAllByLastVisit( $quadrant ) as $locationRow ) {
            $lunchDetails = array();
            $name = $locationRow->Name;
            $locationID = $locationRow->LocationID;
            $punchline = $locationRow->Punchline;
            $distance = $locationRow->DistanceName;
            $abbreviation = $locationRow->Abbreviation;
            $latitude = $locationRow->Latitude;
            $longitude = $locationRow->Longitude;
            $deathDate = $locationRow->DeathDate;

            $frequencyFormatted = FrequencyDAO::formattedForUI( $locationRow->FrequencyCount, $locationRow->FrequencyLatest);

            $lunchDetails['name'] = $name;
            $lunchDetails['latest'] = $frequencyFormatted;
            $lunchSpots[] = $lunchDetails;
        }

        echo json_encode( $lunchSpots );
    }
?>