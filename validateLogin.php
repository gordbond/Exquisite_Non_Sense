<?php
    include "connect.php";

    $passwordLog = filter_input(INPUT_POST, "passwordLog", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $userNameLog = filter_input(INPUT_POST, "userNameLog", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    //Boolean flag to check inputs
    $paramsOK = false;
    $valid = false;
    $data = [];
    //Checks to see if inputs are valid
    if($passwordLog !== null && $userNameLog !== null){
        $paramsOK = true;
    }
    if($paramsOK){
        // $command = "SELECT userName, password1 FROM usersForExCor WHERE userName = ? AND password1 = ? ";
        $command = "SELECT userName, password1 FROM usersForExCor WHERE userName = ?";
        $stmt = $dbh->prepare($command);
        $params = [$userNameLog];
        $success = $stmt->execute($params);


        if($success){
            //$userN = $stmt->fetch()[0];
            //$psw = $stmt->fetch()[0];
            if($stmt->rowCount() > 0){
                $data = array((object)["valid"=>true]);
            }else{
                $data = array((object)["valid"=>false]);
            }
            echo json_encode($data);
        }
        
    }
    
    

    


?>