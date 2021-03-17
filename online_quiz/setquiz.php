<?php

require_once "config.php";
$quizid = "";
if (isset($_GET['qid']) && isset($_GET['auth']) && $_GET['auth'] == 1) {
    // echo $_GET['qid']."<br>"; 
    $quizid = $_GET['qid'];
    $total_questions_querry = "SELECT total_question from quiz where quiz_id=$quizid";
    $total_questions = $database->query($total_questions_querry);
    $tq = $total_questions->fetchColumn(0);
    // echo "inside get";
} else if (isset($_GET['qid']) && isset($_GET['tq'])) {
    $tq = $_GET['tq'];
    $tq = $tq - 1;
    echo $tq . "inside else if<br>";
    $quizid = $_GET['qid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qid = $_POST['quizid'];
    // echo "front of qid<br>";
    // echo $qid."<br>";
    // echo "INSIDE POST<br>";
    $q = $_POST['question'];
    $a = $_POST['optionA'];
    $b = $_POST['optionB'];
    $c = $_POST['optionC'];
    $d = $_POST['optionD'];
    $ans = $_POST['ans'];

    echo $qid . "<br>";
    $add_que = "insert into questions(quiz_id,ques,optionA,optionB,optionC,optionD,correct_option) values('$qid','$q','$a','$b','$c','$d','$ans')";
    $res = $database->query($add_que);
    header("Location:setquiz.php?qid=" . $qid . "&tq=" . $_POST['tq']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set quiz</title>
</head>

<body>
    <form action="setquiz.php" method="POST">
        <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
        <input type="hidden" name="tq" value="<?php echo $tq ?>"> -->
        <?php
        if ($tq > 0) { ?>
            <input type="text" name="question" placeholder="Write Question" required> <br>
            <input type="text" name="optionA" required><br>
            <input type="text" name="optionB" required><br>
            <input type="text" name="optionC" required><br>
            <input type="text" name="optionD" required><br>
            <input type="text" name="ans" required><br>
            <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
            <input type="hidden" name="tq" value="<?php echo $tq ?>">
            <button type="submit" name="submit">Add more Questions</button>
        <?php
        } else {
            echo "Quiz added successfully!<br>";
        ?>
            <a href="teacher.php">Dashboard</a>
        <?php
        }
        ?>
    </form>
</body>

</html>