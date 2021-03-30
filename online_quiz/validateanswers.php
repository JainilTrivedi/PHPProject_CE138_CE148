<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Validate</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
</head>

<body>
    <ul>
        <li>
            <div id="sitename">Online Quiz</div>
        </li>
        <li>
            <a href="student.php" style="text-decoration:none">
                <div id="text2">Home</div>
            </a>
        </li>
    </ul>
    <table class="table" style="margin-top:30px;width:800px;" align="center" border="1px">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Question No.</th>
                <th scope="col">Question</th>
                <th scope="col">Your Answer</th>
                <th scope="col">Correct Answer</th>
                <th scope="col">Verdict</th>
            </tr>
        </thead>
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
                if ($correct_option == 'a') {
                    $correct_answer = $row['optionA'];
                } else if ($correct_option == 'b') {
                    $correct_answer = $row['optionB'];
                } else if ($correct_option == 'c') {
                    $correct_answer = $row['optionC'];
                } else if ($correct_option == 'c') {
                    $correct_answer = $row['optionD'];
                }
                //User has attempted the question in form of option inserted
                //Following is done to display the answer in sentence form 
                $attempted_answer = '';
                if ($attempted_option == 'a') {
                    $attempted_answer = $row['optionA'];
                } else if ($attempted_option == 'b') {
                    $attempted_answer = $row['optionB'];
                } else if ($attempted_option == 'c') {
                    $attempted_answer = $row['optionC'];
                } else if ($correct_option == 'd') {
                    $attempted_answer = $row['optionD'];
                }

                echo '<tr><td>' . $count . '</td><td width="300px">' . $row['ques'] . '</td><td>' . $attempted_answer . '(' . $attempted_option . ')</td><td>' . $correct_answer . ' (' . $correct_option . ')</td>';
                if ($correct_option == $attempted_option) {
                    echo '<td align="center"><img src="images/correct.png" height="30px" width="25px"></td>';
                } else {
                    echo '<td align="center"><img src="images/wrong.png" height="25px" width="30px"></td>';
                }
                // echo "Question-" . $count . " : " . $row['ques'] . '<br>';
                // echo "Your Answer : " . $attempted_answer . ' (' . $attempted_option . ') <br>';
                // echo "Correct Answer : " . $correct_answer . ' (' . $correct_option . ')<br><br>';
                echo '</tr>';
                $count++;
            }
            echo '</table>';
            // echo '<div align="center"><h1>Total correct Answers : ' . $correct . '<br>' . 'Total Wrong answers : ' . $wrong . '<br></div>';
            session_start();
            if (isset($_SESSION['sid'])) {
                $student_id = $_SESSION['sid'];
            }
            $total_marks_query = "SELECT total_marks FROM quiz where quiz_id='$quiz_id'";
            $restotalmarks = $database->query($total_marks_query);
            $total_marks = $restotalmarks->fetchColumn();
            $your_score = ($correct * 100.0) / ($count - 1);
            $your_score = number_format($your_score, 2);    //Upto 2 decimal places
            $insertattemptquery = "INSERT INTO previousattempts(correct_answers,student_id,quiz_id,total_marks,your_score) values ('$correct' ,'$student_id','$quiz_id','$total_marks','$your_score')";
            $result = $database->query($insertattemptquery);
        }
        ?>
        <div style="margin-left:400px;margin-top:30px;margin-right:200px;">
            <div class="jumbotron col-8 m-2">
                <h1 class="display-4">Hello,<?php echo $_SESSION['sname'] ?></h1>
                <p class="lead">Following is the summary of your Result</p>
                <hr class="my-4">
                <p>Total Correct Answers : <?php echo $correct; ?></p>
                <p>Total Wrong Answers : <?php echo $wrong; ?></p>
                <p>Your score : <?php echo $your_score; ?></p>
            </div>
        </div>
</body>

</html>