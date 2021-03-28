<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>
   <link rel="stylesheet" type="text/css" href="navbar.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
   <?php
   require_once "config.php";
   if (isset($_GET['sub'])) {
      $s = $_GET['sub'];
      $select_sub = "SELECT subject_id from `subject` where subject_name='$s'";
      $tmp_sid = $database->query($select_sub);
      $sub_id = $tmp_sid->fetchColumn(0);
   ?>
      <h4 style="margin-top:25px;" align="center"><?php echo "Search results for " . $s . "<br><br>";  ?></h4>
      <div style="outline-style:groove; margin-left:50px; margin-right:50px;margin-top:10px">
         <?php
         $search_subs_query = "SELECT * FROM QUIZ where subject_id=" . $sub_id;
         $search_sub = $database->query($search_subs_query);
         echo '<div class="row">';
         while ($tmp = $search_sub->fetch()) {
         ?>
            <!-- <h5><?php echo "Search results for " . $s;  ?></h5> -->
            <div class="card text-white bg-success mb-3" style="width: 250px;margin:2%">
               <div class="col">
                  <div class="row">
                     <div class="card-header">
                        <h5 align="center"><?php echo $tmp['quiz_name'] ?> </h5>
                     </div>
                     <div class="card-body">
                        <p class="card-title">
                           <?php
                           echo "Total marks: " . $tmp['total_marks'] . "<br>Total questions " . $tmp['total_question'];
                           ?>
                        </p>
                        <p class="card-text"></p>
                        <a href="attempt.php?quizid=<?php
                                                      $quiz_id = $tmp['quiz_id'];
                                                      echo $quiz_id;
                                                      ?>" class="btn btn-outline-warning">Give quiz</a>
                        <br><br>
                     </div>
                  </div>
               </div>
            </div>
      <?php
         }
         echo '</div>';
      }
      ?>
      </div>
</body>

</html>