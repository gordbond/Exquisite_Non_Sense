<?php
/* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    saveDrawing.php is used to save the current drawing to the user's account.
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
    include "connect.php";
    //starts the session

    $access = isset($_SESSION["userName"]);
    //access username via session variable
    $userName = $_SESSION["userName"];
    if($access){
        //image path for head
        $head = filter_input(INPUT_GET, "head", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //image path for body
        $body = filter_input(INPUT_GET, "body", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //image path for legs
        $legs = filter_input(INPUT_GET, "legs", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //ID for head image
        $head_id = filter_input(INPUT_GET, "head_id", FILTER_VALIDATE_INT);
        //ID for body image
        $body_id = filter_input(INPUT_GET, "body_id", FILTER_VALIDATE_INT);
        //ID for legs image
        $legs_id = filter_input(INPUT_GET, "legs_id", FILTER_VALIDATE_INT);

        //Update image paths and IDs for current user
        $command = "UPDATE usersForExCor SET head=?, body=?,legs=?, head_id=?, body_id=?, legs_id=? WHERE userName=?";
        $stmt = $dbh->prepare($command);
        $params = [$head, $body, $legs, $head_id, $body_id, $legs_id, $userName];
        $success = $stmt->execute($params);
    }
    //To be used for debugging in console
    echo("$head, $body, $legs, $head_id, $body_id, $legs_id, $userName");

?>