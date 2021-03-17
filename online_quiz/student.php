<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <title>Student</title>
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
   <h1>Welcome Student</h1>
   <h5>
      <div class="search">

         <form action="student.php" action="GET">
            <input type="text" name="sub">
            <input type="submit" name="submit" value="Search">
         </form>
         Following quizes are available &nbsp;
      </div>
   </h5>
   <?php
   $get_subjects_query = "SELECT * FROM subject";
   $subjects = $database->query($get_subjects_query);

   while ($subject_row = $subjects->fetch()) {
      echo '<h1>' . $subject_row['subject_name'] . '</h1>';
      $subid = $subject_row['subject_id'];
      $get_quiz_by_subject = "SELECT * from quiz where subject_id='$subid'";
      $sub_quizes = $database->query($get_quiz_by_subject);
      while ($quiz_row = $sub_quizes->fetch()) {
   ?>
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
   <?php
      }
   } ?>
</body>

</html>