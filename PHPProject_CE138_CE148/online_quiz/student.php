<?php
session_start();
require_once "config.php";
?>
<?php
if (isset($_GET['attempts']) && $_GET['attempts'] == 1) {
   $studentid = $_SESSION['sid'];
   $getattemptsquery = "SELECT * FROM previousattempts WHERE student_id='$studentid'";
   $attempts = $database->query($getattemptsquery);
   $attempt = 1;
   echo "Attempt : " . $attempt;
}

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
   if (isset($_SESSION['sid']) && isset($_SESSION['sname'])) {
      unset($_SESSION['sid']);
      unset($_SESSION['sname']);
      header('Location:home.php?loggedout=1');
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <title>Student</title>
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET"  && isset($_GET['sub'])) {
   //echo "inside request get";
   $sub = strtoupper($_GET['sub']);
   //echo $sub;
   header("Location:search_sub.php?sub=" . $sub);
}
?>


<body>
   <ul>
      <li>
         <div id="sitename">Online Quiz</div>
      </li>
      <li>
         <div id="text">Welcome,<?php echo $_SESSION['sname']; ?></div>
      </li>
      <li>
         <a href="previousattempts.php">
            <div id="text2">Your attempts</div>
         </a>
      </li>
      <li>
         <div style="margin:8px;">
            <form action="student.php" action="GET">
               <input style="border-radius:10px;width:400px;" type="text" name="sub">
               <input style="width:100px;height:35px;" class=" btn btn-primary" type="submit" name="submit" value="Search">
            </form>
         </div>
      </li>
      <li>
         <a style="margin-top:7px;" class="btn btn-primary" href="student.php?logout=1">Logout</a>
      </li>
   </ul>
   <h1 style="margin-top:10px;" align="center">Following quizes are available</h1> &nbsp;
   <?php
   $get_subjects_query = "SELECT * FROM subject";
   $subjects = $database->query($get_subjects_query);

   while ($subject_row = $subjects->fetch()) {

      $subid = $subject_row['subject_id'];
      $get_quiz_by_subject = "SELECT * from quiz where subject_id='$subid'";
      $sub_quizes = $database->query($get_quiz_by_subject);
      echo '<div class="container col-10" "align="center">';
      echo '<div style="margin-bottom:60px;outline-style:groove;">';
      echo '<h1 align="center">' . $subject_row['subject_name'] . '</h1>';
      echo '<div class="row" align="center" style="padding-left:60px;padding-right:60px;">';
      while ($quiz_row = $sub_quizes->fetch()) {
   ?>
         <div class="row m-2">
            <div class="col">
               <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                  <strong>
                     <div class="card-header"><?php echo $quiz_row['quiz_name']; ?></div>
                  </strong>
                  <div class="card-body">
                     <h5 class="card-title">Marks : <?php echo $quiz_row['total_marks']; ?></h5>
                     <p class="card-text">This quiz contains total <?php echo $quiz_row['total_question']; ?> questions.<br>No negative marking will be there</p>
                     <a class="btn btn-outline-warning" href="attempt.php?quizid=<?php echo $quiz_row['quiz_id']; ?>">Attempt Quiz</a>
                  </div>
               </div>
            </div>
         </div>
   <?php
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
   }
   ?>
</body>

</html>