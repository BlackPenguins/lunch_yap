<?php
    include_once "database.php";
    include_once "dao/LocationDAO.php";

    $locationID = $_POST['locationID'];
    $location = LocationDAO::getWithID( $locationID );

    if( $location != null ) {
        $latitudeNumber = $location->Latitude;
        $latitudeNumber = $latitudeNumber == null ? null : (double) $latitudeNumber;

        $longitudeNumber = $location->Longitude;
        $longitudeNumber = $longitudeNumber == null ? null : (double) $longitudeNumber;

        $deathDateFormatted = $location->DeathDate;

        if( $deathDateFormatted ) {
            $date = DateTime::createFromFormat('Y-m-d', $deathDateFormatted);
            $deathDateFormatted = $date->format("m/d/Y");
        }

        $frequencyFormatted = FrequencyDAO::formattedForUI( $location->FrequencyCount, $location->FrequencyLatest);

        echo json_encode(array(
            'name' => $location->Name,
            'description' => $location->Description,
            'punchline' => $location->Punchline,
            'abbreviation' => $location->Abbreviation,
            'distance' => $location->DistanceName,
            'latitude' => $latitudeNumber,
            'longitude' => $longitudeNumber,
            'menuFileName' => $location->MenuFileName,
            'hasVegan' => $location->HasVegan,
            'hasVegetarian' => $location->HasVegetarian,
            'hasGlutenFree' => $location->HasGlutenFree,
            'hasLactoseFree' => $location->HasLactoseFree,
            'hasTakeout' => $location->HasTakeout,
            'category' => $location->CategoryName,
            'deathDate' => $deathDateFormatted,
            'foodType' => $location->FoodType,
            'travelTime' => $location->TravelTime,
            'hasWifi' => $location->HasWifi,
            'hasCashOnly' => $location->HasCashOnly,
            'parkingType' => $location->ParkingType,
            'waitTime' => $location->WaitTime,
            'quadrant' => $location->Quadrant,
            'cost' => $location->Cost,
            'frequency' => $frequencyFormatted,
        ));
    }
?>