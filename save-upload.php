<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$file = $_FILES['file1'];

// file name 
$name = $file['name'];
echo "Name: $name<br />";

// email 
$email = $_POST['email'];
echo "Email: $email<br />";

// size (1kb = 1024 bytes)
$size = $file['size'];
echo "Size: $size<br />";

// tempoarry file location
$tmp_name = $file['tmp_name'];
echo "Temp Name: $tmp_name<br />";

// check file type 
$type = mime_content_type($tmp_name); // inspects file to make sure file type is correct
echo "Type: $type<br />";

// save file to uploads folder
if ($size < 1024000 && $type == 'image/jpeg') {
    // if file is vaild use the session to make a unique name 
    session_start();
    $name = session_id() . "-" . $name;
    move_uploaded_file($tmp_name, 'uploads/$name');
}
else {
    echo 'invalid file';
}

?>


</body>
</html>