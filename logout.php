<?php
  session_start();
  unset($_SESSION["user"]);
  unset($_SESSION["point"]);
  
  echo("
       <script>
          location.href = 'login.php';
         </script>
       ");
?>
