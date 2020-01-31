<?php
/* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    exquisiteCorpse.php is the main page for the Exquisite Non-Sense exhibition app
    To access the exhibition the username and password must be validated. 
    If not a valid user the user is not allowed access and a 
    link back to the login page is provided.
    Validation is achieved using a session.
    */
//starts the session
session_start();
//connection for database
include "connect.php";
//username from login form
$userName = filter_input(INPUT_POST, "userNameLog", FILTER_SANITIZE_SPECIAL_CHARS);
//password from login form
$password = filter_input(INPUT_POST, "passwordLog", FILTER_SANITIZE_SPECIAL_CHARS);
//Boolean flag to check inputs
$paramsOK = false;
//Check if valid parameters 
if($password !== null && $userName !== null){
    $paramsOK = true;
}

//Retrieves username, password and head.body and legs image paths
if($paramsOK){
        $command = "SELECT userName, password1, head, body, legs FROM usersForExCor WHERE userName = ?";
        $stmt = $dbh->prepare($command);
        $params = [$userName];
        $success = $stmt->execute($params);
        
        
        
        if($success){
            //If a record is returned username is saved to session and password is verified
            if($stmt->rowCount() >0){
                
                $_SESSION["userName"] = $userName;
                $userData = $stmt->fetch();
                //IF password is verified set session variables for head,body and legs with image paths
                if( password_verify($password, $userData["password1"])){
                    if($userData["head"] !== NULL && $userData["body"] !== NULL && $userData["legs"] !== NULL){
                        $_SESSION["head"] = $userData["head"];
                        $_SESSION["body"] = $userData["body"];
                        $_SESSION["legs"] = $userData["legs"];
                    }
                //IF password not verified destroy the session
                }else{
                    echo(password_verify($password, $userData["password1"]));
                    session_unset();
                    session_destroy();
                }
            }
        }else{
            session_unset();
            session_destroy();
        }
}else{
    session_unset();
    session_destroy();
}


?><!DOCTYPE html>
<html>

    <head>
        
        <title>Test for Exquiste Corpse</title>
        <link rel="stylesheet" href="css/stylesExCor.css">
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>

    <body>
        
        <?php 
        //-------------IF session is set provide the Exquisite Non-Sense App----------//
        if(isset($_SESSION["userName"])){
        ?> 
        <div id="container">
            <div class="titleContainer">
                <img src="img/ExquisiteNonSense1.png">
                <div id="randButtonContainer">
                    <img src="img/randButton.png" id="randButton" class="button">
                </div>
                <div id="saveButtonContainer">
                    <img src="img/saveButton.png" id="saveButton" class="button">
                </div>
                <div id="loadButtonContainer">
                    <img src="img/loadButton.png" id="loadButton" class="button">
                </div>
                <div id="logOutButtonContainer">
                    <img src="img/logOutButton.png" id="logOutButton" class="button">
                </div>
                <div id="instructionsContainer">
                <p id="instructions">
                    “Exquisite Non-sense” is an interactive, art exhibition of drawings
                    created by Gord Bond and Evan Bond using the surrealist drawing game, 
                    “Exquisite Corpse”, as a model. Each drawing is broken down 
                    into three parts: head, body and legs. Click to recieve a randomly assembled
                    drawing just for you. If you don't want that drawing just click randomize
                    to get a new one. ORRR click on the head, body or legs to switch them.<br><br>

                    <b style="color:red;">Click on the head, body or legs to flip through your options</b>
                </p>
                
            </div>
        </div>
            <?php
                //If user has exisiting image saved to their user account provide that image
                if($userData["head"] !== NULL && $userData["body"] !== NULL && $userData["legs"] !== NULL){
            ?>
                <div id="fullDrawingContainer" style="display:block;">
                    <div id="headContainer" class="drawingContainer">
                        <img id="head" src=<?=$userData["head"]?> class="drawing">
                    </div>
                    <div id="bodyContainer" class="drawingContainer">
                            <img id="body" src=<?=$userData["body"]?> class="drawing">
                    </div>
                    <div id="legsContainer" class="drawingContainer">
                            <img id="legs" src=<?=$userData["legs"]?> class="drawing">
                    </div>
                </div>
            
                <div id="clickHereContainer" style="display:none;">   
                    <img src="img/clickHereSm.gif"> 
                </div>
            <?php
                //If no existing image in user account leave image paths empty
                }else{
            ?>
                <div id="fullDrawingContainer">
                    <div id="headContainer" class="drawingContainer">
                        <img id="head" src="" class="drawing">
                    </div>
                    <div id="bodyContainer" class="drawingContainer">
                            <img id="body" src="" class="drawing">
                    </div>
                    <div id="legsContainer" class="drawingContainer">
                            <img id="legs" src="" class="drawing">
                    </div>
                </div>
            
                <div id="clickHereContainer">   
                    <img src="img/clickHereSm.gif"> 
                </div>
            <?php
                }
            ?>
        </div>
        
        <script src="exquisiteCorpse.js"></script>

        <?php
        //---------------------IF no session available provide a link back to log in-------------------------//
        }else{
        ?>
        <div id="container">
            <div class="titleContainer" id="invalidTitleContainer">
                <img src="img/ExquisiteNonSense1.png">
            </div>
        </div>
        <h1 id="invalidLoginContainer"><a href="_login.html" id="invalidLogin">Oops! Try again.</a></h1>

        <?php
        }
        ?>
        
    </body>

</html>