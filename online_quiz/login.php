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
            $tid = $teacher_row->fetchColumn(0);
            echo "Login Successful as teacher";
            $_SESSION['tid'] = $tid;
            header('location:teacher.php');
         } else {
            echo "Invalid";
         }
      } else if ($role == "student") {
         $sql = "SELECT * from student WHERE username = '$username' AND password = '$password'";
         $student_row = $database->query($sql);
         $present_student = $student_row->rowCount();
         if ($present_student == 1) {
            echo "Login successful as a student";
            $sid = $student_row->fetchColumn(0);
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
</head>

<body>
   <form action="login.php" method="POST">
      <div align="center">
         <h1>Enter Login details</h1>
         <table>
            <tr>
               <td>Username:</td>
               <td><input type="text" name="uname" required placeholder="Enter Username Here"></td>
            </tr>
            <tr>
               <td>Password:</td>
               <td><input type="password" name="password" required placeholder="Password"></td>
            </tr>
            <input type="hidden" name="role" value="<?php echo $role; ?>">
            <tr>
               <td><input type="submit" name="submit" value="Login!"></td>
            </tr>
         </table>
         <a href="homepage.php">Return Home</a>
      </div>
   </form>
</body>

</html>