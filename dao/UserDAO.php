<?php

include_once "../database.php";

class UserDAO {
    public $UserName;
    public $Password;
    public $FirstName;
    public $LastName;
    public $SlackID;
    public $SodaBalance;
    public $SnackBalance;
    public $PhoneNumber;
    public $SodaSavings;
    public $SnackSavings;
    public $DateCreated;
    public $Inactive;
    public $IsCoop;
    public $AnonName;
    public $Credits;
    public $ShowDiscontinued;
    public $ShowItemStats;
    public $ShowShelf;
    public $ShowCashOnly;
    public $ShowCredit;
    public $SubscribeRestocks;
    public $ShowTrending;
    public $IsVendor;
    public $HideCompletedRequests;


    public static function setFirstName( $userID, $firstName ) {
        $statement = Database::connect()->prepare( "UPDATE User SET FirstName = :firstName WHERE UserID = :userID" );
        $statement->bindValue( ":userID", $userID );
        $statement->bindValue( ":firstName", $firstName );
        $statement->execute();
    }

    public static function getByUserID( $userID ) {
        $statement = Database::connect()->prepare( "SELECT * FROM User WHERE UserID = :userID" );
        $statement->bindValue( ":userID", $userID );

        $result = $statement->fetchAll(PDO::FETCH_CLASS, UserDAO::class);
        return $result;
    }
}