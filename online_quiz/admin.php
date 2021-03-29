<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>
   <link rel="stylesheet" type="text/css" href="navbar.css">
   <link rel="stylesheet" type="text/css" href="abcd.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <style type="text/css">
      #aform {
         margin-left: 200px;
         margin-right: 200px;
         margin-top: 50px;

      }

      #aform form {
         height: 350px;
         width: 600px;
         padding-top: 60px;
      }

      #aform input[type="text"] {
         border-radius: 5px;
         text-align: center;
         border: 2px solid #39CCCC;
         width: 300px;
         height: 40px;
      }

      #aform input[type="password"] {
         border-radius: 5px;
         text-align: center;
         border: 2px solid #39CCCC;
         width: 300px;
         height: 40px;
      }
   </style>
</head>


<?php
session_start();
require_once "config.php";
$num = 1;

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
   if (isset($_SESSION['a_uname'])) {
      unset($_SESSION['a_uname']);
      header('Location:home.php?loggedout=1');
   }
}

if (isset($_GET['remove']) && $_GET['remove'] == 1 && (isset($_GET['tid']))) {
   $removeqid = $_GET['tid'];
   $del_quiz = "DELETE from `teacher` where id='$removeqid'";
   $remove = $database->query($del_quiz);
   header("location:admin.php?loggedin=1");
}

if (isset($_GET['remove']) && $_GET['remove'] == 2 && (isset($_GET['sid']))) {

   $removeqid = $_GET['sid'];
   $del_quiz = "DELETE from `student` where id='$removeqid'";
   $remove = $database->query($del_quiz);
   echo $removeqid;
   header("location:admin.php?loggedin=1&inside=2");
}

if (isset($_GET['newsub'])) {
   $newsubject = $_GET['new_sub'];
   $addsub_query = "INSERT INTO `subject`(subject_name)  VALUES ('$newsubject')";
   $added_newsub = $database->query($addsub_query);
   header("location:admin.php?loggedin=1&inside=2&sss=" . $newsubject);
}


if (isset($_GET['loggedin']) && $_GET['loggedin'] == 1) {

   if (isset($_GET['inside'])) {
      //echo "INSIDE<br>";
   }
   //teachers query
   $teacher_query = "SELECT * from teacher";
   $t = $database->query($teacher_query);

   //students query
   $student_query = "SELECT * from student ";
   $s = $database->query($student_query);

   //print_r($s->fetch());
?>

   <body>
      <ul>
         <li>
            <div id="sitename">Online Quiz</div>
         </li>
         <li>
            <div id="text">Welcome,<?php echo $_SESSION['a_uname']; ?></div>
         </li>
         <li>
            <a style="margin-top:7px;" class="btn btn-primary" href="admin.php?logout=1">Logout</a>
         </li>
      </ul>
      <!-- Teacher tABLE -->
      <table class="table" style="width:400px;" border="1px" align="center">
         <thead class="thead-dark">
            <th colspan="2">Teacher</th>
         </thead>
         <thead>
            <th>Name</th>
            <th>Action</th>
         </thead>

         <?php while ($rows = $t->fetch()) { ?>
            <tr>
               <td> <?php echo $rows['firstname'] . " " . $rows['lastname']  ?> </td>
               <td> <a class="btn btn-danger" href="admin.php?remove=1&tid=<?php echo $rows['id'] ?>"> Remove</a> </td>
            </tr>
            <br><br>
         <?php } ?>
      </table>
      <br>
      <!-- Student table -->
      <table class="table" style="width:400px;" align="center" border="1px">
         <thead class="thead-dark">
            <th colspan="2"> <b> Students </b></th>
         </thead>
         <thead>
            <th>Name</th>
            <th>Action</th>
         </thead>
         <?php while ($r = $s->fetch()) {
         ?>
            <tbody>
               <tr>
                  <td> <?php echo $r['firstname'] . "" . $r['lastname'] ?> </td>
                  <td> <a class="btn btn-danger" href="admin.php?remove=2&sid=<?php echo $r['id'] ?>"> Remove</a> </td>
               </tr>
            </tbody>
         <?php } ?>
      </table>
      <br>

      <table class="table" style="width:400px;" align="center" border="1px">
         <thead class="thead-dark">
            <th colspan="2">Current Subjects</th>
         </thead>
         <thead>
            <th>Sr. No.</th>
            <th>Subjact Name</th>
         </thead>
         <?php
         $subject_query = "SELECT * FROM subject";
         $get_subject = $database->query($subject_query);
         while ($sub = $get_subject->fetch()) { ?>
            <tbody>
               <tr>
                  <td> <?php echo $num;
                        $num += 1 ?> </td>
                  <td> <?php echo $sub['subject_name'];   ?></td>
               </tr>

            <?php  }
            ?>
            <form action="admin.php" action="GET">
               <tr>
                  <td><input type="text" name="new_sub" placeholder="Subject Name"></td>
                  <td><input type="submit" class="btn btn-danger" name="newsub" value="Add sub"></td>
               </tr>
            </form>
            </tbody>
      </table>


   <?php
   die();
}
   ?>
   <?php
   if ($_SERVER["REQUEST_METHOD"] = "POST") {
      if (isset($_POST["submit"])) {
         $username = $_POST['uname'];
         $password = $_POST['pass'];

         //teachers query
         $admin_query = "SELECT * from `admin` WHERE username = '$username' AND password = '$password'";
         $admin_fetched = $database->query($admin_query);
         $row_fetched_t = $admin_fetched->rowCount();
         $adres = $admin_fetched->fetch();
         if ($row_fetched_t == 1) {
            $usernamer = $adres['username'];
            $_SESSION['a_uname'] = $usernamer;
            header("location:admin.php?loggedin=1");
         } else {
            echo "Invalid Login credentials";
         }
      }
   }
   ?>

   <div align="center" id="aform">
      <form action="admin.php" class="form-control" method="POST">
         <h1 align="center" style="margin-bottom:30px;">Admin login</h1>
         <div class="form-group">
            <input type="text" name="uname" required placeholder="Username">
         </div>
         <div class="form-group">
            <input type="password" name="pass" placeholder="Password" required>
         </div>
         <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" name="submit" value="Login">Login</button>
         </div>
      </form>
   </div>
   </body>

</html>