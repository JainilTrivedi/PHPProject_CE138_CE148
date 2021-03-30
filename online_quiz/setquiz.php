<?php
session_start();
require_once "config.php";
$quizid = "";
if (isset($_GET['qid']) && isset($_GET['auth']) && $_GET['auth'] == 1) {
    $quizid = $_GET['qid'];
    $total_questions_querry = "SELECT total_question from quiz where quiz_id=$quizid";
    $total_questions = $database->query($total_questions_querry);
    $tq = $total_questions->fetchColumn(0);
} else if (isset($_GET['qid']) && isset($_GET['tq'])) {
    $tq = $_GET['tq'];
    $tq = $tq - 1;
    $_GET['added'] = 1;
    $quizid = $_GET['qid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qid = $_POST['quizid'];
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
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Set quiz</title>
</head>
<style type="text/css">
    #qform input[type="text"] {
        border-radius: 5px;
        text-align: center;
        border: 2px solid #39CCCC;
        width: 500px;
        height: 40px;
    }
</style>

<body>
    <ul>
        <li>
            <div id="sitename">Online Quiz</div>
        </li>
        <li>
            <div id="text">Welcome,Professor <?php echo $_SESSION['tname']; ?></div>
        </li>
    </ul>
    <div align="center">
        <?php if (isset($_GET['added']) && $_GET['added'] == 1) {
            echo '<font color="green"><h3>Question Added</h3></font>';
        } ?>
    </div>
    <div align="center" id='qform' style="margin-top:10px;margin-left:200px;margin-right:200px;">
        <form action="setquiz.php" method="POST" class="form-control" style="height:500px;">
            <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
            <input type="hidden" name="tq" value="<?php echo $tq ?>">
            <?php
            if ($tq > 0) { ?>
                <div align="center">
                    <h1>Add Your Question below</h1>
                </div>
                <div class="form-group">
                    <input type="text" name="question" placeholder="Write Question" required>
                </div>
                <div class="form-group">
                    <input type="text" name="optionA" required placeholder="OptionA">
                </div>
                <div class="form-group">
                    <input type="text" name="optionB" required placeholder="OptionB">
                </div>
                <div class="form-group">
                    <input type="text" name="optionC" required placeholder="OptionC">
                </div>
                <div class="form-group">
                    <input type="text" name="optionD" required placeholder="OptionD">
                </div>
                <div class="form-group">
                    Correct Option :
                    <select required name="ans">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <input type="hidden" name="quizid" value="<?php echo $quizid ?>">
                <input type="hidden" name="tq" value="<?php echo $tq ?>">
                <div class="form-group">
                    <button class="btn btn-warning" type="submit" name="submit">Add more Questions</button>
                </div>
            <?php
            } else {
                echo '<div align="center" style="margin-top:30px;"><font color="green"><h1>Quiz added successfully!</h1></font><br>';
            ?>
                <a style="margin-top:10px;" class="btn btn-success btn-lg" href="teacher.php" role="button">Home</a>
    </div>
    </div>
<?php
            }
?>
</form>
</body>

</html>