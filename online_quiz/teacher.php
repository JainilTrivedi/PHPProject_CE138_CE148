<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Teacher</title>
</head>
<?php
   if(isset($_GET) && $_GET["role"]==1 ){
      echo "Welcome,Teacher<br><br>";
   }
?>
<body>
   <a href="home.php">Logout</a>
</body>
</html>