<?php
require_once "config.php";
session_start();
if (isset($_SESSION['tid'])) {
   $teacher_id = $_SESSION['tid'];
}
$getsubjects = 'SELECT * from subject';
$subjects = $database->query($getsubjects);

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
   if (isset($_SESSION['tid']) && isset($_SESSION['tname'])) {
      unset($_SESSION['tid']);
      unset($_SESSION['tname']);
      header('Location:home.php?loggedout=1');
   }
}

//This is to remove the quiz
if (isset($_GET['remove']) && $_GET['remove'] == 1 && (isset($_GET['r_qid']))) {
   $removeqid = $_GET['r_qid'];
   $del_quiz = "DELETE from quiz where quiz_id='$removeqid'";
   $remove = $database->query($del_quiz);
   //Quiz with given id will be removed and its questions from questions table will also be removed because of ON DELETE CASCADE
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $teacher_id = $_POST['teacher_id'];
   $quiz_name = $_POST['quiz_name'];
   $total_marks = $_POST['total_marks'];
   $total_questions = $_POST['total_questions'];
   $subject_id = $_POST['subject_id'];
   $insert_quiz = "insert into quiz(quiz_name,total_marks,total_question,teacher_id,subject_id) values ('$quiz_name','$total_marks','$total_questions','$teacher_id','$subject_id')";
   $database->query($insert_quiz);

   //Following is done to get the id of last inserted quiz
   $getquizids = "SELECT quiz_id from quiz order by quiz_id DESC";
   $result = $database->query($getquizids);
   $r = '';

   $rows = $result->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
   $recent = $rows[0];
   $recent_qid = $recent;
   // header('Location:setquiz.php?qid=' . $recent_qid);
   header("Location:setquiz.php?qid=" . $recent_qid . "&auth=1");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher</title>
   <link rel="stylesheet" type="text/css" href="css/navbar.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<ul>
   <li>
      <div id="sitename">Online Quiz</div>
   </li>
   <li>
      <div id="text">Welcome,Professor <?php echo $_SESSION['tname']; ?></div>
   </li>
   <li>
      <a style="margin-top:7px;" class="btn btn-primary" href="teacher.php?logout=1">Logout</a>
   </li>
</ul>
<h3 align="center"> Quiz's added by You </h3>
<?php
$showquizquery = "SELECT * from quiz where teacher_id=$teacher_id ";
$all_quiz = $database->query($showquizquery);
//quiz_name total_marks total_question
?>
<table class="table" style="width:800px;" align="center" border="1px">
   <thead class="thead-dark">
      <tr>
         <th scope="col">No.</th>
         <th scope="col">Name</th>
         <th scope="col">Total Questions</th>
         <th scope="col">Total Marks</th>
         <th scope="col">Subject</th>
         <th scope="col">Remove</th>
      </tr>
   </thead>
   <tbody>
      <?php
      $i = 1;
      while ($row = $all_quiz->fetch()) { ?>
         <tr>
            <td>
               <?php
               echo $i;
               ?>
            </td>
            <td>
               <?php
               echo $row['quiz_name'] . '<br>';
               ?>
            </td>
            <td>
               <?php
               echo $row['total_question'];
               ?>
            </td>
            <td>
               <?php
               echo $row['total_marks'];
               ?>
            </td>
            <td>
               <?php
               $subid = $row['subject_id'];
               $getsubject = "SELECT subject_name FROM subject where subject_id='$subid'";
               $result = $database->query($getsubject);
               echo $result->fetchColumn();
               ?>
            </td>
            <td>
               <?php $r_qid = $row['quiz_id']; ?>
               <a class="btn btn-danger" href="teacher.php?remove=1&r_qid= <?php echo $r_qid; ?>">Remove Quiz</a>
            </td>
         </tr>
      <?php $i++;
      }
      ?>
   </tbody>
</table>

<body>
   <div align="center">
      <a class="btn btn-warning" href="teacher.php?addquiz=1">Add a quiz</a> <br>
   </div>
   <div align="center">
      <?php
      if (isset($_GET['addquiz']) && $_GET['addquiz'] == 1) { ?>
         <form action="teacher.php" method="POST" class="form-control mt-3">
            <table>
               <tr>
                  <td>
                     Subjects :
                  </td>
                  <td>
                     <select required name="subject_id">
                        <?php
                        while ($r = $subjects->fetch()) { ?>
                           <option value="<?php echo  $r['subject_id']; ?>"><?php echo $r['subject_name'] ?></option>
                        <?php } ?>
                     </select>
                  </td>
               </tr>
               <tr>
                  <td>
                     Quiz Name :
                  </td>
                  <td>
                     <input required type="text" name="quiz_name" placeholder="Quiz name">
                  </td>
               </tr>
               <tr>
                  <td>
                     Total marks :
                  </td>
                  <td>
                     <input required type="number" name="total_marks" placeholder="Total marks">
                  </td>
               </tr>
               <tr>
                  <td>
                     Total Questions :
                  </td>
                  <td>
                     <input required type="number" name="total_questions" placeholder="Total questions">
                     <input required type="hidden" name="teacher_id" value="<?php echo $teacher_id ?>">
                  </td>
               </tr>
               <tr>

                  <td>
                     <input class="btn btn-outline-danger" type="submit" name="add" value="Add Quiz">
                  </td>

               </tr>
            </table>
         </form>
   </div>
<?php } ?>
</body>

</html>