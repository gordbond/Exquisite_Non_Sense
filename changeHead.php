<?php
  /* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    changeHead.php is used to get the path for the next head image in the database.
    It is structured so the user can loop endlessly through all the different options.
    To achieve this, the first and last IDs are found. Then if the next ID is greater than 
    the last ID in the database it returns to the first ID. 
    The new path is returned.
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
//connection for database
include_once "connect.php";

//current head ID
$currentHeadID = filter_input(INPUT_GET, "currentHeadID", FILTER_VALIDATE_INT);

//Boolean Flag to check parameters
$paramsOK =false;

//Check if parameters OK
if($currentHeadID !== false && $currentHeadID !== null){
    $paramsOK = true;
}

//ID of the first head image
$firstId;
//ID of the last head image
$lastId;
//NextNum is the ID after the current one
$nextNum = $currentHeadID + 1;

if($paramsOK){
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

    //Return to first ID if nextNum greater than last ID
    if($nextNum > $lastId){
        $nextNum = $firstId;
    }

    

    //Retrieve the next ID 
    $command = "SELECT head FROM imgFiles WHERE img_id = ?";
    $stmt = $dbh->prepare($command);
    $param = [$nextNum];
    $success = $stmt->execute($param);

    $head = $stmt->fetch()[0];
    //Preparing JSON object to return
    $data = array((object)["head"=>$head, "currentHeadID"=>$nextNum]);


//Return head image path and ID
echo json_encode($data);
}
?>