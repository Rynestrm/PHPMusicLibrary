<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // end session and direct to log in page 
    session_start();
    session_unset(); //removes session variables
    session_destroy();
    
    header('location:login.php');
    
    ?>
</body>
</html>