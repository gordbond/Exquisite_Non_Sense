<?php
/**
 * Include this to connect. Change the dbname to match your database,
 * and make sure your login information is correct after you upload 
 * to csunix or your app will stop working.
 * 
 * Sam Scott, Mohawk College, 2019
 * 
 * --------------------------------------------------
 * 
 * Adapted this from Sam Scott's connect.php
 * I only changed the dbname
 * Gord Bond, 000786196

 *Date Created: Nov.30, 2019
 *I, Gord Bond, 000786196 certify that this material is my original work. No other person's work 
 *has been used without due acknowledgement.
 * 
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=bondgw_ex_cor",
        "bondgw_glorbo123",
        "Abc12de3$"
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
?>