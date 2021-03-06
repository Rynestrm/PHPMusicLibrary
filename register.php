<?php
$title = 'Register';
require_once ('header.php');
?>

<main class="container">
    <h1>User Registration</h1>
    <form method="post" action="save-registration.php">
        <fieldset class="form-group">
            <label for="username" class="col-md-2">Username:</label>
            <input name="username" id="username" required type="email" placeholder="email@email.com" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-md-2">Password:</label>
            <input type="password" name="password" id="password" required
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-md-2">Confirm Password:</label>
            <input type="password" name="confirm" id="confirm" required
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        </fieldset>
        <div class="g-recaptcha" data-sitekey="6LdDG-oUAAAAADG7kIISUKKJIavzcs7acTF8PN2b"></div>
        <div class="offset-md-2">
            <input type="submit" value="Register" class="btn btn-info" />
        </div>
    </form>
</main>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php
require_once 'footer.php';
?>
