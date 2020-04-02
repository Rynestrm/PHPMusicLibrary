<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- from https://www.w3schools.com/bootstrap4/bootstrap_navbar.asp -->

<nav class="headerColor navbar navbar-expand-md">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">Music Library</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="musicians.php">View Musicians</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="musician-details.php">Add New Musician</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
</nav>

<!-- <script src="js/scripts.js" type="text/javascript"></script> -->


