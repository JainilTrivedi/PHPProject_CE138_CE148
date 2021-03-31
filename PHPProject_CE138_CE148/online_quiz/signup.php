<html>

<head>
    <title>Signup</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form class="box" action="signup.php" method="post">
                        <?php
                        session_start();
                        if (isset($_GET['errors']) && $_GET['errors'] == 1) {
                            if (isset($_SESSION['error'])) {
                                $errors = $_SESSION['error'];
                                // $errors = explode('\n', $errors);
                                $errors = array($errors);
                                foreach ($errors as $key => $val) {
                                    echo '<font color="red">' . $val . '</font>';
                                }
                                unset($_SESSION['error']);
                            }
                        }
                        ?>
                        <h1>Signup</h1>
                        <p>Please fill up your registration details</p>
                        <input type="text" name="fname" placeholder="Firstname">
                        <input type="text" name="lname" placeholder="Lastname">
                        <input type="email" name="email" placeholder="Email-id">
                        <input type="text" name="phoneno" placeholder="Phone number" id='phoneno'>
                        <input type="text" name="uname" placeholder="Choose Username">
                        <font color="white"><label for="role">Role : </label></font>
                        <select name="role" id="role">
                            <option value="Teacher">Teacher</option>
                            <option value="Student">Student</option>
                        </select>
                        <input type="password" id='pass1' name="pass" placeholder="Password">
                        <input type="password" id='pass2' name="pass2" placeholder="Confirm Password">
                        <input type="submit" name="submit" value="Signup!" href="#">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
require_once "config.php";
if (isset($_POST['submit'])) {
    $error = '';
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $contact = $_POST['phoneno'];
    $email = $_POST['email'];
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $role = $_POST['role'];
    $errorpresent = False;
    //To validate if Teacher with same username already exists
    if ($role == "Teacher") {
        $getteacherusernamequery = "SELECT * from teacher where username='$username'";
        $execute = $database->query($getteacherusernamequery);
        $rows = $execute->rowCount();
        if ($rows >= 1) {
            $errorpresent = True;
            $error = $error . "User with that username already exists";
        }
    }
    //To validate if Student with same username already exists
    else if ($role == "Student") {
        $getstudentswithusername = "SELECT * FROM student where username='$username'";
        $exec = $database->query($getstudentswithusername);
        $srows = $exec->rowCount();
        if ($srows >= 1) {
            $errorpresent = True;
            $error = $error . "User with that username already exists";
        }
    }
    //To validate if password is minimum 8 characters in length
    if (strlen($password) < 8) {
        $error = $error . "\nPassword must be 8 characters in length";
        $errorpresent = True;
    }
    //To validate if password contains atleast 1 digit
    if (!preg_match("#[0-9]+#", $password)) {
        $error = $error . "Password must contain atleast 1 digit";
        $errorpresent = True;
    }
    //To validate if password contains atleast 1 uppercase letter
    if (!preg_match("#[A-Z]+#", $password)) {
        $error = $error . "Password must contain atleast one uppercase letter";
        $errorpresent = True;
    }
    //To validate if password contains atleast 1 lowercase letter
    if (!preg_match("#[a-z]+#", $password)) {
        $error = $error . "Password must contain atleast one Lowercase letter";
        $errorpresent = True;
    }
    //To validate if password contains atleast 1 special character
    if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
        $error = $error . "Password must contain atleast one special character";
        $errorpresent = True;
    }
    //To validate if contact number is of 10 digits
    if (strlen($contact) < 10 || strlen($contact) > 10) {
        $error = $error . "\nPhone no must be 10 of digits only";
        $errorpresent = True;
    }
    if ($errorpresent) {
        $_SESSION['error'] = $error;
        header('Location:signup.php?errors=1');
    } else {
        if ($role == "Teacher") {
            $insert_query = "insert into `teacher`(firstname,lastname,Email,Phone_no,username,password) values ('$firstname','$lastname','$email','$contact','$username','$password')";
            $database->query($insert_query);
            //To get the id of last inserted teacher
            $getteacheridsquery = "Select id FROM teacher order by id DESC";
            $getidqexec = $database->query($getteacheridsquery);
            $trows = $getidqexec->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            $tid = $trows[0];
            $_SESSION['tid'] = $tid;
            $_SESSION['tname'] = $firstname;
            header('Location:teacher.php');
        } else if ($role == "Student") {
            $insert_query = "insert into `student`(firstname,lastname,email,contact,username,password) values ('$firstname','$lastname','$email','$contact','$username','$password')";
            $database->query($insert_query);
            //To get the id of last inserted student
            $getstudentquery = "Select id FROM student order by id DESC";
            $getsidqexec = $database->query($getstudentquery);
            $srows = $getsidqexec->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            $sid = $srows[0];
            $_SESSION['sid'] = $sid;
            $_SESSION['sname'] = $firstname;
            header('Location:student.php');
        } else {
            echo "Invalid";
        }
    }
}
?>