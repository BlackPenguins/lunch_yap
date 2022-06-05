<?php
    include_once "database.php";
    include_once "dao/LocationDAO.php";
    include_once "dao/FrequencyDAO.php";


    $mode = null;

    if( isset( $_GET['mode'] ) ) {
        $mode = $_GET['mode'];
    }

    if( $mode == "search_visits" ) {
        $lunchSpots = array();
        $quadrant = $_GET['quadrant'];

        foreach (LocationDAO::getAllByLastVisit( $quadrant ) as $locationRow ) {
            $lunchDetails = array();
            $name = $locationRow->Name;
            $daysAgoFormatted = FrequencyDAO::formattedForUI( $locationRow->FrequencyCount, $locationRow->FrequencyLatest);

            $latestDateFormatted = null;
            if( $locationRow->FrequencyCount >  0 ) {
                $latestDate = DateTime::createFromFormat('Y-m-d', $locationRow->FrequencyLatest);
                $latestDateFormatted = $latestDate->format( "m/d/Y");
            }

            $lunchDetails['name'] = $name;
            $lunchDetails['visit_count'] = $locationRow->FrequencyCount;
            $lunchDetails['latest_visit_date'] = $latestDateFormatted;
            $lunchDetails['time_ago_label'] = $daysAgoFormatted;
            $lunchSpots[] = $lunchDetails;
        }

        echo json_encode( $lunchSpots );
    } else if( $mode == "add_frequency" ) {
        $response = "";

        if( isset( $_GET['location'] ) ) {
            $locationName = $_GET['location'];
            $locationRow = LocationDAO::getWithName($locationName);

            if ($locationRow == null) {
                $response = "Could not find a name with **$locationName** for a location name.";
            } else {
                $locationID = $locationRow->LocationID;
                $locationName = $locationRow->Name;
                FrequencyDAO::insert($locationID);
                $response = "A visit today has been added for **$locationName**.";
            }
        } else {
            $response = "You must provide a location!";
        }
        echo  json_encode( [ 'message' => $response ] );
    } else {
        echo "The API does not support this mode.";
    }
?>