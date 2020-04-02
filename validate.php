<?php

$username = $_POST['username'];
$password = $_POST['password'];

require_once 'db.php';

$sql = "SELECT userId, password FROM users WHERE username = :username";

$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();

$user = $cmd->fetch();

if (!password_verify($password, $user['password'])) {
    echo 'Invalid Login';
    exit();	
}
else {
    // handle a valid login 
    session_start(); // access the current session 
    $_SESSION['userid'] = $user['userid']; //soore user id from our query
    header('location: musicians.php'); // redirect to new page
}

$db = null;

?>