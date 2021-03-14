<html>
   <head>
      <title>Login Page</title>
   </head>
   <body>
      <form action="redirecting.php" method="POST">
         <div align="center">
            <h1>Enter Login details</h1>
               <table>
                  <tr>
                     <td>Username:</td>
                     <td><input type="text" name="uname" placeholder="Enter Username Here"></td>
                  </tr>
                  <tr>
                     <td>Password:</td>
                     <td><input type="password" name="password"  placeholder="Password"></td>
                  </tr>
                  <tr>
                     <td><input type="submit" name="submit" value="Login as teacher"></td>
                  </tr>
               </table>
            <a href="home.php">Return Home</a>
         </div>
      </form>
   </body>
</html>