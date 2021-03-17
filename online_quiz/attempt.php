<?php
require_once "config.php";
if (isset($_GET['quizid'])) {
    //echo $_GET['quizid'];
    $qid = $_GET['quizid'];
    $get_questoins_query = "SELECT * FROM questions where quiz_id=" . $qid;
    $got_all = $database->query($get_questoins_query);
    //echo $got_all->fetch();
    $count = 0;
    echo "<h5>The Questions are</h5>";
?><form action="validateanswers.php" method="POST">
        <?php
        while ($got_all_questions = $got_all->fetch()) {
            $count++;
        ?>

            <!DOCTYPE HTML>
            <html>

            <head>
                <title>Attempt Quiz</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            </head>

            <body>
                <div class="card" style="width: 300;margin:2%">
                    <div class="card-header">
                        <?php echo "Question" . $count . ": " . $got_all_questions["ques"] . "<br>";  ?>
                    </div>
                    <div class="card-body">
                        <p class="card-title">
                            <input type="radio" name="quesid<?php echo $got_all_questions['question_id']; ?>" value="A"> <?php echo $got_all_questions['optionA'] . '<br>';  ?>
                        </p>
                        <p class="card-title">
                            <input type="radio" name="quesid<?php echo $got_all_questions['question_id']; ?>" value="B"> <?php echo $got_all_questions['optionB'] . '<br>';  ?>
                        </p>
                        <p class="card-title">
                            <input type="radio" name="quesid<?php echo $got_all_questions['question_id']; ?>" value="C"> <?php echo $got_all_questions['optionC'] . '<br>';  ?>
                        </p>
                        <p class="card-text">
                            <input type="radio" name="quesid<?php echo $got_all_questions['question_id']; ?>" value="D"> <?php echo $got_all_questions['optionD'] . '<br>';  ?>
                        </p>
                        <input type="hidden" name="quizid" value="<?php echo $qid ?>">
                    </div>
                </div>
            <?php
        }
            ?>
            <button class="btn btn-primary btn-lg" type="submit" name="submit" value="Submit!">
    </form>

<?php
}
?>
</body>

</html>