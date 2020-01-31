<?php

    /* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    registration.php is used for two purposes:
        1) To check whether a user already exists in the database. 
        2) a)If user DOES exist - do not add user and return false
           b)If user DOES NOT exist - add user to database along with hashed 
             password and return true
    */

   

    //connection for database
    include "connect.php";
    //1st password from registration form
    $passwordReg1 = filter_input(INPUT_POST, "passwordReg1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //2nd password from registration form
    $passwordReg2 = filter_input(INPUT_POST, "passwordReg2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //username from registration form
    $userNameReg = filter_input(INPUT_POST, "userNameReg", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //Boolean flag to check inputs
    $paramsOK = false;
    //Boolean flag returned to say whether registration was successful
    $registered = false;
    

        

    //Checks to see if inputs are valid
    if($passwordReg1 !== null && $passwordReg2 !== null && $userNameReg !== null){
        $paramsOK = true;
    }

    
    /**
     * If parameters are OK check to see if username exists. 
     * If username doesn't already exist add username and password to database
     */
    if($paramsOK){
        //Checks database for existing username
        $command = "SELECT * FROM usersForExCor WHERE userName = ?";
        $stmt = $dbh->prepare($command);
        $params = [$userNameReg];
        $success = $stmt->execute($params);

        //If username doesn't exist
        if($stmt->rowCount() === 0){
            //Hashes and salts user password 
            $hash = password_hash($passwordReg1, PASSWORD_DEFAULT);

            //Adds username and password to database
            $command = "INSERT INTO usersForExCor (id, userName, password1) VALUES (NULL, ?, ?)";
            $stmt = $dbh->prepare($command);
            $params = [$userNameReg, $hash];
            $success = $stmt->execute($params);

            //Confirms successful entry
            if($success){
                $registered = true;    
            }
        }
    }
    //Returns whether registration was successful or not
    echo json_encode($registered);

    


?>