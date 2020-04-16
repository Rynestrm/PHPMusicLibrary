<?php
// 1. get the form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;


// 2. validate the inputs 
if (empty($username)) {
    echo "username required";
    $ok = false;
}

if (empty($password)) {
    echo "password required";
    $ok = false;
}

if ($password != $confirm) {
    echo "passwords do not match";
    $ok = false;
}

// capcha
$secret = "6LdDG-oUAAAAACgxxPTLKQcsOa0ZIyyjPgImFUOA";
$userResponce = $_POST['g-recaptcha-response'];

// use curl library
$apiRequest = curl_init();
curl_setopt($apiRequest, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
curl_setopt($apiRequest, CURLOPT_RETURNTRANSFER, true);
curl_setopt($apiRequest, CURLOPT_POST, true);

// create an aray
$apiPostData = array();
$apiPostData['secret'] = $secret;
$apiPostData['responce'] = $userResponce;
curl_setopt($apiRequest, CURLOPT_POSTFIELDS, $apiPostData);

// execute api request
$apiResult = curl_exec($apiRequest);
curl_close($apiRequest);

// convert json to aray
$resultArray = json_decode($apiResult, true);

// check if captcha is successful
if ($resultArray['success'] == false) {
    echo 'Are you human?';
    $ok = false;
}

if ($ok) {
    // 3. connect 
    require_once 'db.php';
    // 3a. check if user name exsts
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    // if we find a record that exists stop and dont insert 
    if ($user != null) {
        echo "User already exists";
        exit(); // this stops any more php from executing.
    }
    
    // 4. set up SQL insert into tables 
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);
    // 5. hash for paswork saving 
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // 6. bind parmaiters and execute the inset
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $hashedPassword, PDO::PARAM_STR, 255);
    $cmd->execute();

    // 7. disconnect and redirect to login
    $db = null;
    header('location:login.php');
}
?>
