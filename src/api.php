<?php
    include_once "database.php";
    include_once "dao/LocationDAO.php";
    include_once "dao/CategoryDAO.php";
    include_once "dao/DistanceDAO.php";
    include_once "dao/FrequencyDAO.php";


    $mode = null;

    if( isset( $_GET['mode'] ) ) {
        $mode = $_GET['mode'];
    }

    if( $mode == "search_visits" ) {
        $lunchSpots = array();

        foreach (LocationDAO::getAllByLastVisit() as $locationRow ) {
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
                FrequencyDAO::inseert($locationID);
                $response = "A visit today has been added for **$locationName**.";
            }
        } else {
            $response = "You must provide a location!";
        }
        echo  json_encode( [ 'message' => $response ] );
    } else if( $mode == "add_location" ) {
        $response = "";

        if( !isset( $_GET['location'] ) ) {
            $response = "You must provide a location!";
        } else {
            if( !isset( $_GET['author'] ) ) {
                $response = "You must provide an author! We need someone to blame.";
            } else {
                $locationName = $_GET['location'];
                $author = $_GET['author'];
                $category = CategoryDAO::findByName("Sit Down");

                if ($category == null) {
                    $response = "Could not find a **Sit Down** location. Yell at Matt!";
                } else {
                    $distance = DistanceDAO::findByName("Long Drive");

                    if ($distance == null) {
                        $response = "Could not find a **Long Drive** distance. Yell at Matt!";
                    } else {

                        $categoryID = $category->CategoryID;
                        $distanceID = $distance->DistanceID;

                        LocationDAO::create($locationName, $categoryID, "Added through YapBot by $author", "", "", $distanceID, "Cheap", "", "", "", false, false, false, false, false,
                            "", "", 0, false, false, "", 0, "Henrietta", true);
                        $response = "Location **$locationName** was added.";
                    }
                }
            }
        }
        echo  json_encode( [ 'message' => $response ] );
    } else {
        echo "The API does not support this mode.";
    }
?>