<?php

    /* 
    Final Project - "Exquisite Non-Sense"
    Gord Bond, 000786196
    I, Gord Bond, 000786196, certify that this material is my original work. 
    No other person's work has been used without due acknowledgement.

    Summary:

    logOut.php is used to destroy the current session
    */
    session_start();
    session_unset();
    session_destroy();

    echo($_SESSION["userName"]);
?>