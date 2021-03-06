<?php

$title = 'Musicians';
require_once('header.php');

?>
<h1>Musician List</h1>
<?php

if (!empty($_SESSION['userId'])) {
echo '<a href="musician-details.php">Add a New Musician</a>';
}
// connect
require_once('db.php');

// set up & execute query
$sql = "SELECT * FROM musicians";
$cmd = $db->prepare($sql);
$cmd->execute();
$musicians = $cmd->fetchAll();

// start table
echo '<table class="table table-striped table-hover"><thead><th>Name</th><th>Label</th><th>Ranking</th><th>Solo</th><th>City</th><th></th></thead>';

// loop through data and display the results
foreach ($musicians as $value) {
    echo '<tr><td>';
    if (!empty($_SESSION['userId'])) {
        echo '<a href="musician-details.php?musicianId=' . $value['musicianId'] . '">' . $value['name'] . '</a>';
    }
    else {
        echo $value['name'];
    }
        echo '</td>
        <td>' . $value['recordLabel'] . '</td>
        <td>' . $value['ranking'] . '</td>
        <td>' . $value['solo'] . '</td>
        <td>' . $value['city'] . '</td>
        <td>';

        if (!empty($value['photo'])) {
            echo '<uploads/images/' . $value['photo'] . '"alt="musicial photo" class="thumbnail" />';
        }

        // show delete links only to users that are logged in 
        echo '</td>';
        if (!empty($_SESSION['userId'])) {
            echo '<td><a class="text-danger" href="delete-musicians.php?musicianId=' . $value['musicianId'] . '"
            onclick="return confirmDelete();">Delete</a></td>
            </tr>';
        }
}

echo '</table>';
?>
<script src="js/scripts.js"></script>
<?php 
    require_once('footer.php');
?>
