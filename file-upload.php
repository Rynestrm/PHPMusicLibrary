<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="save-upload.php" enctype="multipart/form-data">
        <fieldset>
            <label for="file1">Upload any file</label>
            <input name="file1" type="file">
        </fieldset>
        <fieldset>
            <label for="email">Email: </label>
            <input name="email" type="email" id="email">
        </fieldset>
        <button>Upload Now</button>
    </form>
</body>
</html>