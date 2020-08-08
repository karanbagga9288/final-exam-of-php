<?php

require_once('connect.php');

//define a flag variable
$ok = true;

// grab the information from the form and also validate

$uname = trim(filter_input(INPUT_POST, 'username'));
$upassword = trim(filter_input(INPUT_POST, 'password'));

if(empty($uname)) {
    echo "<p> Please provide your username! </p>";
    $ok = false;
}
if(empty ($upassword)){
    echo "<p> Please provide your password! </p>";
    $ok = false;
}

//validate the credentials

if($ok === true ) {
    //set up query to see if a username matches
    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    //prepare
    $stmt = $db->prepare($sql);
    //bind
    $stmt->bindParam(":username", $uname);
    //execute
    $stmt->execute();
    //is the data present in the database?
    if($stmt->rowCount() == 1){
        //if so, let's fetch it
        if($row = $stmt->fetch()) {
            //use password verify to check the users password against the hash password
            if(password_verify($upassword, $row["password"])) {
                //password matches, let's start a session;
                session_start();
                //create session variables to store the user's name and user_id from the table
                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                //direct user to restricted page
                header("location:view.php");
            }
            else {
                echo "<p> Problem validating your password!</p>";
            }
        }
        else {
            echo "<p> Error accessing your data!</p>";
        }
    }
    else {
        echo "<p> No user found!</p>";
    }
}
else {
    echo "<p> Sorry something went wrong! </p>";
}
//close database connection
$stmt->closeCursor();
?>
