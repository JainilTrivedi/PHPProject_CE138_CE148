<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search</title>

   <!--CSS BOOTSTRAP LINK   -->
   <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" 
      rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"
   >
</head>
<body>
<?php
   require_once "config.php";
   if(isset($_GET['sub'])){
      $s=$_GET['sub'];
      $select_sub="SELECT subject_id from `subject` where subject_name='$s'";
      $tmp_sid=$database->query($select_sub);
      $sub_id= $tmp_sid->fetchColumn(0);
?>

<h5><?php  echo "Search results for ".$s."<br><br>";  ?></h5>

<?php
      $search_subs_query="SELECT * FROM QUIZ where subject_id=".$sub_id;
      $search_sub=$database->query($search_subs_query);
      while($tmp=$search_sub->fetch()){
?> 
<!-- <h5><?php  echo "Search results for ".$s;  ?></h5> -->
      <div class="card" style="width: 250px;margin:2%"  >
         <div class="col">
            <div class="row">
               <div class="card-header">
               <h5><?php  echo "Quiz name: ".$tmp['quiz_name'] ?> </h5>
               </div>
               <div class="card-body">
                  <p class="card-title">
                     <?php 
                        echo "Total marks: ".$tmp['total_marks']."<br>Total questions ".$tmp['total_question'];
                     ?>
                  </p>
                  <p class="card-text"></p>
                  <a href="attempt.php?quizid=<?php  
                     $quiz_id=$tmp['quiz_id'] ;
                     echo $quiz_id;
                  ?>" class="btn btn-primary">Give quiz</a>
                  <br><br>
               </div>
            </div>
         </div>
      </div>
<?php
      }
   }
?>


</body>
</html>