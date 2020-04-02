<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Artists Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>

<?php
// initialize variables
$musicianId = null;
$name = null;
$recordLabel = null;
$ranking = null;
$solo = null;
$photo = null;
$city = null;
$checked = null;

// check if there's a musicianId in the url string
if (!empty($_GET['musicianId'])) {
    // if there is a musicianId, query the db for the details on this record so we can populate the form
    $musicianId = $_GET['musicianId'];

    $db = new PDO('mysql:host=172.31.22.43;Ivan100039992', 'Ivan100039992', 'lv_T9J2gGY');
    $sql = "SELECT * FROM artists WHERE musicianId = $musicianId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':musicianId', $musicianId, PDO::PARAM_INT);
    $cmd->execute();
    $musician = $cmd->fetch();  // use fetch for a single record.  It's faster than fetchAll()

    // populate the variables from the query result
    $name = $musician['name'];
    $recordLabel = $musician['recordLabel'];
    $ranking = $musician['ranking'];
    $solo = $musician['solo'];
    $photo = $musician['photo'];
    $city = $musician['city'];

    if ($musician['solo'] == true) {
        $checked = "checked";
    }
}
?>

<form method="post" action="saveArtists.php">
    <fieldset>
        <label for="name" class="col-md-2">Name: *</label>
        <input name="name" id="name" required maxlength="100" value="<?php echo $name; ?>" />
    </fieldset>
    <fieldset>
        <label for="recordLabel" class="col-md-2">Record Label:</label>
        <input name="recordLabel" id="recordLabel" maxlength="50" value="<?php echo $recordLabel; ?>" />
    </fieldset>
    <fieldset>
        <label for="ranking" class="col-md-2">Ranking:</label>
        <input name="ranking" id="ranking" type="number" min="0" value="<?php echo $ranking; ?>" />
    </fieldset>
    <fieldset>
        <label for="solo" class="col-md-2">Solo:</label>
        <input name="solo" id="solo" type="checkbox" <?php echo $checked; ?> />
    </fieldset>
    <fieldset>
        <label for="photo" class="col-md-2">Photo:</label>
        <input name="photo" id="photo" value="<?php echo $photo; ?>" />
    </fieldset>
    <fieldset>
        <label for="city" class="col-md-2">City:</label>
        <input name="city" id="city" maxlength="50" value="<?php echo $city; ?>" />
    </fieldset>
    <input type="hidden" name="musicianId" id="musicianId" value="<?php echo $musicianId; ?>" />
    <button class="offset-md-2 btn btn-primary">Save</button>
</form>

</body>
</html>
