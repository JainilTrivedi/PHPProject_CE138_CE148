<?php
require_once "config.php";
session_start();
if (isset($_SESSION['tid'])) {
   $teacher_id = $_SESSION['tid'];
}
$getsubjects = 'SELECT * from subject';
$subjects = $database->query($getsubjects);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher</title>
</head>

<body>
   <h1>Welcome Teacher</h1>
   <table>
      <a href="teacher.php?addquiz=1">Add a quiz</a>
   </table>
   <?php
   if (isset($_GET['addquiz']) && $_GET['addquiz'] == 1) { ?>
      <form action="teacher.php" method="POST">
         <table>
            <tr>
               <td>
                  <select name="subject_id">
                     <?php
                     while ($r = $subjects->fetch()) { ?>
                        <option value="<?php echo $r['subject_id']; ?>"><?php echo $r['subject_name'] ?></option>
                     <?php } ?>
                  </select>
               </td>
            </tr>
            <tr>
               <td>
                  Quiz Name :
               </td>
               <td>
                  <input type="text" name="quiz_name" placeholder="Quiz name">
               </td>
            </tr>
            <tr>
               <td>
                  Total marks :
               </td>
               <td>
                  <input type="number" name="total_marks" placeholder="Total marks">
               </td>
            </tr>
            <tr>
               <td>
                  Total Questions :
               </td>
               <td>
                  <input type="number" name="total_questions" placeholder="Total questions">
                  <input type="hidden" name="teacher_id" value="<?php echo $teacher_id ?>">
               </td>
            </tr>
            <tr>
               <td>
                  <input type="submit" name="add" value="Add Quiz">
               </td>
            </tr>
         </table>
      </form>
   <?php } ?>
</body>

</html>
<?php
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $teacher_id = $_POST['teacher_id'];
   $quiz_name = $_POST['quiz_name'];
   $total_marks = $_POST['total_marks'];
   $total_questions = $_POST['total_questions'];
   $subject_id = $_POST['subject_id'];
   // echo "Teacher id : " . $teacher_id . '<br>' . "Quiz name : " . $quiz_name . '<br>' . "Total marks : " . $total_marks . '<br>' . "Total questions : " . $total_questions;
   $insert_quiz = "insert into quiz(quiz_name,total_marks,total_question,teacher_id,subject_id) values ('$quiz_name','$total_marks','$total_questions','$teacher_id','$subject_id')";
   $database->query($insert_quiz);

   //Following is done to get the id of last inserted quiz
   $getquizids = "SELECT quiz_id from quiz";
   $result = $database->query($getquizids);
   $r = '';
   while ($result->fetch()) {
      $r = $result->fetch();
   }
   $id_in_int = (int)$r['quiz_id'];
   echo $id_in_int;
   header("Location:setquiz.php?quizid=" . $id_in_int);
}
?>