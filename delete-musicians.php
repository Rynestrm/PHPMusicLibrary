<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>

<?php
// read the selected musicianId from the value at the end of the url
$musicianId = $_GET['musicianId'];

// connect to the db
require_once('db.php');


// set up SQL command to delete the selected record
$sql = "DELETE FROM musicians WHERE musicianId = :musicianId";

// bind Parameter to pass in the selected id
$cmd = $db->prepare($sql);
$cmd->bindParam(':musicianId', $musicianId, PDO::PARAM_INT);

// execute the SQL command
$cmd->execute();

// disconnect
$db = null;

// take the user back to the updated list (so they can see the selected record is now gone)
header('location:musicians.php');
?>

</body>
</html>
