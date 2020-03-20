<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="<?= asset("bootstrap/css/bootstrap.min.css"); ?>" rel="stylesheet" id="bootstrap-css">
    <link href="<?= asset("bootstrap/css/bootstrap-grid.min.css"); ?>" rel="stylesheet" id="bootstrap-css">
    <link href="<?= asset("css/login.css"); ?>" rel="stylesheet">
</head>
<body>
    <div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
        <img src="http://danielzawadzki.com/codepen/01/icon.svg" id="icon" alt="User Icon" />
        </div>

        <!-- Login Form -->
        <form>
        <input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
        <input type="text" id="password" class="fadeIn third" name="login" placeholder="password">
        <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
        <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
    </div>
</body>
<footer>
    <script src="<?=asset("js/jquery.min.js")?>"></script>
</footer>
</html>

