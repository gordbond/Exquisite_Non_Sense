<?php
/* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    load.php is used to retrieve the image paths associated with the session variable 
    userName. This allows the app to load the image the user has saved when the page first loads
*/
//starts the session
session_start();
//Boolean flag for session    
$sessionOK = false;
//Checks to see if session is ok. 
//Back to index if not.
$_SESSION['access'] = filter_input(INPUT_GET, "access", FILTER_VALIDATE_BOOLEAN);

if(isset($_SESSION["userName"])){
    $sessionOK = true;
} else{
    session_unset();
    session_destroy();
    header("location:exquisiteCorpse.php");
    exit();
}
//connect to the database
include_once "connect.php";
//provide class for creating JSON with all necessary image info
include_once "fullDrawing.php";

//Array of image paths to be returned
$imgPaths = [];


//GET user IMAGE
$command = "SELECT head, body, legs, head_id, body_id, legs_id FROM usersForExCor WHERE userName = ?";
$stmt = $dbh->prepare($command);
$param = [$_SESSION["userName"]];
$success = $stmt->execute($param);

if($success){
$drawing = $stmt->fetch();

//New fullDrawing object
$drawing = new fullDrawing($drawing[0], $drawing[1], $drawing[2],$drawing[3], $drawing[4], $drawing[5]);

//prepare json object
$imgPaths[0] = $drawing;
}

//return image paths for drawing
echo json_encode($imgPaths);


?>

