<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Redirecting Page</title>
</head>

<?php
$uname=$pass="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
   
   $uname=$_POST["uname"];
   $pass=$_POST["password"];

   $sql=  "select * from  teacher  where username='$uname' and password='$pass' " ;
   try{
      $dbhandler = new PDO('mysql:host=localhost;dbname=online_quiz', 'root', '');
      $querry=$dbhandler->query($sql);
      $t=$querry->fetch();
      if(isset($t) && !empty($t))
      {
         if($t["role"]=="Teacher"){
            header("location:teacher.php?role=1");
         }else if($t["role"]=="Student"){
            header("location:student.php?role=1");
         }
         echo "<h1>Signin Successful</h1><br>";
      }
      else {
         echo "Invalid Login Credentials<br>";
      }
   }catch(PDOException $p){
      echo $p;
   }
}
?>
<body>
   <a href="homepage.html">Return Home</a>
</body>
</html>