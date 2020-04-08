<?php

require_once('header.php');

require_once('auth.php');
// save inputs
$musicianId = $_POST['musicianId'];  // we need the id if we are updating an existing record
$name = $_POST['name'];
$recordLabel = $_POST['recordLabel'];
$ranking = $_POST['ranking'];

// default solo to false
$solo = false;

// change solo to true if the user checked the solo checkbox
if (!empty($_POST['solo'])) {
    $solo = true;
}

$photo = $_FILES['photo'];
$city = $_POST['city'];

// validate inputs
$ok = true; // variable to determine if we should save or not

if (empty($name)) {
    echo 'Name is required<br />';
    $ok = false;
}

// strlen is a PHP function that shows the length of a string value
elseif (strlen($name) > 100) {
    echo 'Name must be 100 characters or less<br />';
    $ok = false;
}

// ! means NOT / false.  is_numeric is a PHP function that checks if a value is an integer or not
if (!empty($ranking)) {
    if (!is_numeric($ranking)) {
        echo 'Ranking must be a number 0 or higher<br />';
        $ok = false;
    }
    if ($ranking < 0) {
        echo 'Ranking must be a number 0 or higher<br />';
        $ok = false;
    }
}

// photo upload check 
if (!empty($photo['name'])) {
    $tmp_name = $photo['tmp_name'];
    $type = mime_content_type($tmp_name);

    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo "Please upload a .jpg or .png<br/>";
        $ok = false;
    } else {
        // use session to name uploaded file 
        session_start();
        $photo = session_id() . "-" . $photo['name'];
        move_uploaded_file($temp_name, 'uploads/images/$photo');
    }
}

// is the form ok?
if ($ok == true) {
    // connect
    require_once('db.php');

    // set up insert or update
    if (empty($musicianId)) {
        $sql = "INSERT INTO musicians (name, recordLabel, ranking, solo, photo, city) VALUES (:name, :recordLabel, :ranking, :solo, :photo, :city)";
    }
    else {
        $sql = "UPDATE musicians SET name = :name, recordLabel = :recordLabel, ranking = :ranking, solo = :solo,
            photo = :photo, city = :city WHERE musicianId = :musicianId";
    }

    $cmd = $db->prepare($sql);

    // bind the variables into the INSERT command
    $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);
    $cmd->bindParam(':recordLabel', $recordLabel, PDO::PARAM_STR, 50);
    $cmd->bindParam(':ranking', $ranking, PDO::PARAM_INT);
    $cmd->bindParam(':solo', $solo, PDO::PARAM_BOOL);
    $cmd->bindParam(':photo', $photo, PDO::PARAM_STR, 100);
    $cmd->bindParam(':city', $city, PDO::PARAM_STR, 50);

    if (!empty($musicianId)) {
        $cmd->bindParam(':musicianId', $musicianId, PDO::PARAM_INT);
    }

    // save to db
    $cmd->execute();

    // disconnect
    $db = null;

    //echo 'Musician Saved';
    header('location:musicians.php');
}

require_once('footer.php');
?>