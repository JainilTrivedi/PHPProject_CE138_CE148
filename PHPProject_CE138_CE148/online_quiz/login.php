<html>
<?php
session_start();
$role = "";
require_once "config.php";
if (isset($_GET['teacher'])) {
   if ($_GET['teacher'] == 1) {
      $role = "teacher";
   } else if ($_GET['teacher'] == 0) {
      $role = "student";
   }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (isset($_POST['submit'])) {
      $username = $_POST['uname'];
      $password = $_POST['password'];
      $role = $_POST['role'];
      if ($role == "teacher") {
         $sql = "SELECT * from teacher WHERE username = '$username' AND password = '$password'";
         $teacher_row = $database->query($sql);
         //$present_teacher = $teacher_row->fetchColumn(); //Count 
         $count = $teacher_row->rowCount();
         if ($count == 1) {
            $tres = $teacher_row->fetch();
            $tid = $tres['id'];
            $tname = $tres['firstname'];
            echo "Login Successful as teacher";
            $_SESSION['tid'] = $tid;
            $_SESSION['tname'] = $tname;
            header('location:teacher.php');
         } else {
            echo "Invalid";
         }
      } else if ($role == "student") {
         $sql = "SELECT * from student WHERE username = '$username' AND password = '$password'";
         $student_row = $database->query($sql);
         $present_student = $student_row->rowCount();
         if ($present_student == 1) {
            $sres = $student_row->fetch();
            $studentname = $sres['firstname'];
            $_SESSION['sname'] = $studentname;
            echo "Login successful as a student";
            $sid = $sres['id'];
            echo "Student id : " . $sid;
            $_SESSION['sid'] = $sid;
            echo $_SESSION['sid'];
            header('location:student.php');
         } else {
            echo "Invalid login";
         }
      }
   }
}
?>

<head>
   <title>Login Page</title>
   <link rel="stylesheet" type="text/css" href="css/styles.css">
   <link rel="stylesheet" type="text/css" href="css/button.css">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col md-6">
            <div class="card">
               <form action="login.php" class="box" method="POST">
                  <div align="center">
                     <h1>Enter Login details</h1>
                     <input type="text" name="uname" required placeholder="Enter Username Here">
                     <input type="password" name="password" required placeholder="Password">
                     <input type="hidden" name="role" value="<?php echo $role; ?>">
                     <input type="submit" name="submit" value="Login!">
                     <p>Don't have an account ? </p>
                  </div>
                  <a class="button" href="signup.php">Register</a>
                  <a class="button" href="home.php">Home</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</body>

</html>