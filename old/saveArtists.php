<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// save inputs
$artistsId = $_POST['musicianId'];  // we need the id if we are updating an existing record
$name = $_POST['name'];
$recordLabel = $_POST['recordLabel'];
$ranking = $_POST['ranking'];

// default solo to false
$solo = false;

// change solo to true if the user checked the solo checkbox
if (!empty($_POST['solo'])) {
    $solo = true;
}

$photo = $_POST['photo'];
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

// is the form ok?
if ($ok == true) {
    // connect
    $db = new PDO('mysql:host=172.31.22.43;Ivan100039992', 'Ivan100039992', 'lv_T9J2gGY');

    // set up insert or update
    if (empty($musicianId)) {
        $sql = "INSERT INTO artists (name, recordLabel, ranking, solo, photo, city) VALUES
        (:name, :recordLabel, :ranking, :solo, :photo, :city)";
    }
    else {
        $sql = "UPDATE artists SET name = :name, recordLabel = :recordLabel, ranking = :ranking, solo = :solo,
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
    header('location:artistsDatabase.php');
}
?>

</body>
</html>
