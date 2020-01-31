<?php
/* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    getImg,php is used to retrieve a set of random image paths from
    the imgFiles table. Specifically it retrieves image paths for the head,
    body and legs.
*/

//starts the session
session_start();
//Boolean flag for session    
$sessionOK = false;
//Checks to see if session is ok. 
//Back to index if not.
if(isset($_SESSION["userName"])){
    $sessionOK = true;
} else{
    session_unset();
    session_destroy();
    header("location:exquisiteCorpse.php");
    exit();
}
//connect to database
include_once "connect.php";
//provide class for creating JSON with all necessary image info
include_once "fullDrawing.php";


//$option = filter_input(INPUT_GET, "option", FILTER_VALIDATE_INT);

//first ID in imgFiles table
$firstId;
//last ID in imgFiles table
$lastId;
//Array of image paths to be returned
$imgPaths = [];

//Get first id
$command = "SELECT img_id FROM imgFiles LIMIT 1";
$stmt = $dbh->prepare($command);
$success = $stmt->execute();
$firstId = (int)$stmt->fetch()[0];

//Get last id
$command = "SELECT img_id FROM imgFiles ORDER BY img_id DESC LIMIT 1";
$stmt = $dbh->prepare($command);
$success = $stmt->execute();
$lastId = (int)$stmt->fetch()[0];


//GET HEAD IMAGE
$headID = rand($firstId,$lastId);
$command = "SELECT head FROM imgFiles WHERE img_id = ?";
$stmt = $dbh->prepare($command);
$param = [$headID];
$success = $stmt->execute($param);

$head = $stmt->fetch()[0];

//GET BODY IMAGE
$bodyID = rand($firstId,$lastId);
$command = "SELECT body FROM imgFiles WHERE img_id = ?";
$stmt = $dbh->prepare($command);
$param = [$bodyID];
$success = $stmt->execute($param);

$body = $stmt->fetch()[0];


//GET LEGS IMAGE
$legsID = rand($firstId,$lastId);
$command = "SELECT legs FROM imgFiles WHERE img_id = ?";
$stmt = $dbh->prepare($command);
$param = [$legsID];
$success = $stmt->execute($param);

$legs = $stmt->fetch()[0];

//CREATE fullDrawing object
$drawing = new fullDrawing($head, $body, $legs,$headID, $bodyID, $legsID);

//prepare json object
$imgPaths[0] = $drawing;


//Echo back
echo json_encode($imgPaths);


?>

