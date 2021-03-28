<?php
session_start();
require_once "config.php";
$studentid = $_SESSION['sid'];
$getattemptsquery = "SELECT * FROM previousattempts WHERE student_id='$studentid'";
$attempts = $database->query($getattemptsquery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Previous attempts</title>
</head>

<body>
    <h1 align="center">Your previous attempts</h1>
    <table class="table" style="width:800px;" align="center" border="1px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Quiz name</th>
                <th scope="col">Subject</th>
                <th scope="col">Total questions</th>
                <th scope="col">Correct Answers</th>
                <th scope="col">Your score(in %)</th>
                <th scope="col">Total marks</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            while ($a = $attempts->fetch()) {
                $qid = $a['quiz_id'];
                $getquizquery = "Select quiz_name,total_question,subject_id from quiz where quiz_id='$qid'";
                $quizresult = $database->query($getquizquery);
                $quizres = $quizresult->fetch();
                $quizname = $quizres['quiz_name'];
                $totalquestions = $quizres['total_question'];
                $subid = $quizres['subject_id'];
                $getsubjectquery = "Select subject_name from subject where subject_id='$subid'";
                $getsubjects = $database->query($getsubjectquery);
                $subject = $getsubjects->fetchColumn();
                echo '<tr>
                    <td>' . $i . '</td>
                    <td>' . $quizname . '</td>
                    <td>' . $subject . '</td>
                    <td>' . $totalquestions . '</td>
                    <td>' . $a['correct_answers'] . '</td>
                    <td>' . $a['your_score'] . ' %</td>
                    <td>' . $a['total_marks'] . '</td>
                </tr>';
                $i++;
            } ?>
        </tbody>
    </table>
</body>

</html>