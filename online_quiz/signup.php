<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="abcd.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="signup.php" method="post">
                        <h1>Signup</h1>
                        <p>Please fill up your registration details</p>
                        <input type="text" name="fname" placeholder="Firstname">
                        <input type="text" name="lname" placeholder="Lastname">
                        <input type="email" name="email" placeholder="Email-id">
                        <input type="text" name="phoneno" placeholder="Phone number">
                        <input type="text" name="uname" placeholder="Choose Username">
                        <label for="role">Role</label>
                        <select name="role" id="role">
                            <option value="Teacher">Teacher</option>
                            <option value="Student">Student</option>
                        </select>
                        <input type="password" name="pass" placeholder="Password">
                        <input type="password" name="pass2" placeholder="Confirm Password">
                        <input type="submit" name="submit" value="Signup!" href="#">
                    </form>
                </div>
            </div>
        </div>
        <table align="right">
            <tr>
                <td>
                    <small>
                        <font style="text-align:right;" color="black">* indicates that it will be considered the preferred subject</font>
                    </small>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php
require_once "config.php";
if (isset($_POST['submit'])) {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contact = $_POST['phoneno'];
    $email = $_POST['email'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $role = $_POST['role'];
    if ($role == "Teacher") {
        $insert_query = "insert into `teacher`(firstname,lastname,Email,Phone_no,username,password) values ('$firstname','$lastname','$email','$contact','$username','$password')";
        $database->query($insert_query);
    } else if ($role == "Student") {
        $insert_query = "insert into `student`(firstname,lastname,email,contact,username,password) values ('$firstname','$lastname','$email','$contact','$username','$password')";
        $database->query($insert_query);
    } else {
        echo "Invalid";
    }
}
?>      