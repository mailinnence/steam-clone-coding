<!--
보안
모든 인젝션 공격 보안
csrf

-->


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>
</head>
<body>
<h3>아이디 중복체크</h3>
<p>
<?php
include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\0.db_info.php";



   $user = $_GET["user"];
   $user   = htmlspecialchars($_GET["user"]);

   if(!$user)
   {
      echo("<li>아이디를 입력해 주세요!</li>");
   }
   else
   {

       $sql = $con->prepare( "select * from users where user=(:user);" );
       $sql->bindParam( ':user', $user, PDO::PARAM_STR);
       $sql->execute();
       $row = $sql->fetch();

      if ($sql->rowCount())
      {
         echo "<li>".$user." 아이디는 중복됩니다.</li>";
         echo "<li>다른 아이디를 사용해 주세요!</li>";
      }
      else
      {
         echo "<li>".$user." 아이디는 사용 가능합니다.</li>";
      }

       $con = null;

   }
?>
</p>
<div id="close">
   <img src="./img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>

