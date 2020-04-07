<?php
// authentication check
// we will cal session_start in teh header so it is not needed on this page
if (empty($_SESSION['userId'])){
    header('location: login.php');
    exit();
}

?>