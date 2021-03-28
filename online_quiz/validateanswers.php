<?php
require_once "config.php";
$correct = 0;
$wrong = 0;
if (isset($_POST['submit'])) {
    $quiz_id = $_POST['quizid'];
    $getquestions = "Select * from questions where quiz_id='$quiz_id'";
    $questionsfromdb = $database->query($getquestions);
    $count = 1;
    while ($row = $questionsfromdb->fetch()) {
        $quesid = $row['question_id'];
        $attempted_option = strtolower($_POST['quesid' . $quesid]);
        $correct_option = strtolower($row['correct_option']);
        if ($attempted_option == $correct_option) {
            $correct = $correct + 1;
        } else {
            $wrong = $wrong + 1;
        }

        $correct_answer = '';
        //We have just saved correct option in database.
        //Following is done to get the correct answer as sentence form from Database
        if ($correct_option == 'A') {
            $correct_answer = $row['optionA'];
        } else if ($correct_option == 'B') {
            $correct_answer = $row['optionB'];
        } else if ($correct_option == 'C') {
            $correct_answer = $row['optionC'];
        } else if ($correct_option == 'D') {
            $correct_answer = $row['optionD'];
        }
        //User has attempted the question in form of option inserted
        //Following is done to display the answer in sentence form 
        $attempted_answer = '';
        if ($attempted_option == 'A') {
            $attempted_answer = $row['optionA'];
        } else if ($attempted_option == 'B') {
            $attempted_answer = $row['optionB'];
        } else if ($attempted_option == 'C') {
            $attempted_answer = $row['optionC'];
        } else if ($correct_option == 'D') {
            $attempted_answer = $row['optionD'];
        }
        echo "Question-" . $count . " : " . $row['ques'] . '<br>';
        echo "Your Answer : " . $attempted_answer . ' (' . $attempted_option . ') <br>';
        echo "Correct Answer : " . $correct_answer . ' (' . $correct_option . ')<br><br>';
        $count++;
    }
    echo 'Total correct Answers : ' . $correct . '<br>' . 'Total Wrong answers : ' . $wrong . '<br>';
    session_start();
    if (isset($_SESSION['sid'])) {
        $student_id = $_SESSION['sid'];
    }
    // $student_id = $_SESSION["sid"];
    $total_marks_query = "SELECT total_marks FROM quiz where quiz_id='$quiz_id'";
    $restotalmarks = $database->query($total_marks_query);
    $total_marks = $restotalmarks->fetchColumn();
    $your_score = ($correct * 100.0) / ($count - 1);
    $your_score = number_format($your_score, 2);    //Upto 2 decimal places
    // echo "\nStudent id : " . $student_id . "\nTotal marks : " . $total_marks . "\nCorrect : " . $correct . "Your score : " . $your_score;
    $insertattemptquery = "INSERT INTO previousattempts(correct_answers,student_id,quiz_id,total_marks,your_score) values ('$correct' ,'$student_id','$quiz_id','$total_marks','$your_score')";
    $result = $database->query($insertattemptquery);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validate</title>
</head>

<body>

</body>

</html>