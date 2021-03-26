<?php 
   require_once "config.php"; 
   if (isset($_GET['remove']) && $_GET['remove'] == 1 && (isset($_GET['tid']))) {
      $removeqid = $_GET['tid'];
      $del_quiz = "DELETE from `teacher` where id='$removeqid'";
      $remove = $database->query($del_quiz);
      header("location:admin.php?loggedin=1");
   }
   
   if(isset($_GET['remove']) && $_GET['remove'] == 2 && (isset($_GET['sid']))){
      
      $removeqid = $_GET['sid'];
      $del_quiz = "DELETE from `student` where id='$removeqid'";
      $remove = $database->query($del_quiz);
      echo $removeqid;
      header("location:admin.php?loggedin=1&inside=2");
   }
   if( isset($_GET['loggedin']) && $_GET['loggedin']==1 ){
      //if($row_fetched_t==1 ){   
         if(isset($_GET['inside'])){
            echo "INSIDE<br>";
         }
         //teachers query
         $teacher_query="SELECT * from teacher";
         $t=$database->query($teacher_query);
         
         //students query
         $student_query="SELECT * from student ";
         $s=$database->query($student_query);

         //print_r($s->fetch());
         ?>
         <!-- Teacher tABLE -->
            <table  class="table" style="width:400px;margin:2%" border="1px" align="center">
               
               <thead>
                  <th colspan="2" >Teacher</th>
               </thead>
               <thead>
                  <th>Name</th>
                  <th>Action</th>
               </thead>

         <?php   while($rows=$t->fetch()){ ?>

               <tr>
                 <td> <?php echo $rows['firstname']." ".$rows['lastname']  ?> </td>
                 <td> <a href="admin.php?remove=1&tid=<?php echo $rows['id'] ?>"> Remove</a> </td>
               </tr>
            <br><br>
            <?php } ?>
            </table>
           
           <!-- Student table -->
            <table class="table" style="width:800px;" align="center" border="1px">
               <thead>
                  <th colspan="2" >  <b> Students </b></th>
               </thead>
               <thead>
                  <th>Name</th>
                  <th>Action</th>
               </thead>
            <?php while($r=$s->fetch()){   
               ?>
               <tbody>
               <tr>
                  <td> <?php  echo $r['firstname']."".$r['lastname'] ?>  </td>
                  <td> <a href="admin.php?remove=2&sid=<?php echo $r['id'] ?>"> Remove</a> </td>
               </tr>
               </tbody>
         <?php } ?>
         </table>
         <?php           
         die();
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <title>Admin</title>
</head>
<body>
<?php

   
   if($_SERVER["REQUEST_METHOD"] = "POST"){
      if(isset($_POST["submit"])){
         $username=$_POST['uname'];
         $password=$_POST['pass'];
         
         //teachers query
         $admin_query="SELECT * from `admin` WHERE username = '$username' AND password = '$password'";
         $admin_fetched=$database->query($admin_query);
         $row_fetched_t=$admin_fetched->rowCount();

         if($row_fetched_t==1){
            header("location:admin.php?loggedin=1");
         }
         
         
         else{
            echo "Invalid Login credentials";
         }
      }
   }
?>

   <h1 align="center" >Admin login</h1>
   <form action="admin.php" method="POST">
      <table  align="center" >
         <tr>
            <td>Username: <input type="text" name="uname" required> <br> </td>
         </tr>
         <tr>
            <td>Password: <input type="password" name="pass" required><br></td>
         </tr>
         <tr colspan=2 align="center" > 
            <td><button type="submit" name="submit" value="Login">Login</button> </td>
         </tr>
         
      </table>
   </form>
</body>

</html>