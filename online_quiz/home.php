<html>

<head>
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">
    <link rel="stylesheet" type="text/css" href="navbar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div style="opacity:0.7;" id='back' align="center">
        <div id='sitename'>
            Online Quiz
        </div>
    </div>
    <?php
    if (isset($_GET['loggedout']) && $_GET['loggedout'] == 1) {
        echo '<font color="green"><h2 align="center" style="margin-top:30px;">Successfully Logged Out!</h2></font>';
        $_GET['loggedout'] = 0;
    }
    ?>
    <div class="buttons">
        <a class="btn btn-outline-primary" href="login.php?teacher=1">Login as Teacher</a>
        <a class="btn btn-outline-primary" href="login.php?teacher=0">Login as Student</a>
        <a class="btn btn-outline-primary" href="signup.php">Register</a>
        <a class="btn btn-outline-primary" href="admin.php">Admin Panel</a>
    </div>
</body>

</html>