<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Musician Library</title>
    <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
<h1>Musician List</h1>
<a href="musician-details.php">Add a New Musician</a>
<?php
// connect
$db = new PDO('mysql:host=172.31.22.43;Ivan100039992', 'Ivan100039992', 'lv_T9J2gGY');

// set up & execute query
$sql = "SELECT * FROM artists";
$cmd = $db->prepare($sql);
$cmd->execute();
$musicians = $cmd->fetchAll();

// start table
echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Label</th><th>Ranking</th><th>Solo</th><th>City</th></thead>';

// loop through data and display the results
foreach ($musicians as $value) {
    echo '<tr><td><a href="musician-details.php?musicianId=' . $value['musicianId'] . '">' . $value['name'] . '</a></td>
        <td>' . $value['recordLabel'] . '</td>
        <td>' . $value['ranking'] . '</td>
        <td>' . $value['solo'] . '</td>
        <td>' . $value['city'] . '</td>
        <td><a class="text-danger" href="delete-musician.php?musicianId=' . $value['musicianId'] . '"
            onclick="return confirmDelete();">Delete</a></td>
        </tr>';
}

echo '</table>';
?>

<!-- include our custom js library -->
<script src="js/scripts.js" type="text/javascript"></script>

</body>
</html>
