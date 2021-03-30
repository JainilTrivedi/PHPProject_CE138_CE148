<?php
require_once "config.php";
if (isset($_GET['quizid'])) {
    $qid = $_GET['quizid'];
    $get_questoins_query = "SELECT * FROM questions where quiz_id=" . $qid;
    $got_all = $database->query($get_questoins_query);
    $count = 0;
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>Attempt Quiz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
        <div align="center">
            <h1>Following all questions are mandatory</h1>
            <h1>Good,luck</h1>
        </div>
        <form action="validateanswers.php" method="POST" class="form-control">
            <?php
            while ($got_all_questions = $got_all->fetch()) {
                $count++;
            ?>
                <div class="card text-white bg-secondary" style="margin:2%">
                    <div class="card-header">
                        <?php echo "Question" . $count . ": " . $got_all_questions["ques"] . "<br>";  ?>
                    </div>
                    <div class="card-body">
                        <p class="card-title">
                            <input required type="radio" name="quesid<?php echo $got_all_questions["question_id"]; ?>" value="A"> <?php echo $got_all_questions['optionA'] . '<br>';  ?>
                        </p>
                        <p class="card-title">
                            <input required type="radio" name="quesid<?php echo $got_all_questions["question_id"]; ?>" value="B"> <?php echo $got_all_questions['optionB'] . '<br>';  ?>
                        </p>
                        <p class="card-title">
                            <input required type="radio" name="quesid<?php echo $got_all_questions["question_id"]; ?>" value="C"> <?php echo $got_all_questions['optionC'] . '<br>';  ?>
                        </p>
                        <p class="card-text">
                            <input required type="radio" name="quesid<?php echo $got_all_questions["question_id"]; ?>" value="D"> <?php echo $got_all_questions['optionD'] . '<br>';  ?>
                        </p>
                        <input type="hidden" name="quizid" value="<?php echo $qid ?>">
                    </div>
                </div>
            <?php
            }
            ?>
            <div align="center">
                <input style="margin-left:30px; width:200px;" class="btn btn-success btn-lg" type="submit" name="submit" value="Submit!">
            </div>
        </form>

    <?php
}
    ?>
    </body>

    </html>