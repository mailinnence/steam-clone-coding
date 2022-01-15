<?php

if (isset($_SESSION["user"])) $user = $_SESSION["user"];
else $user = "";
if (isset($_SESSION["point"])) $point = $_SESSION["point"];
else $point = "";

?>


   <?php
        if(!$user) {
        ?>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <div class="container">
                <h1 id="테마"><a href="main.php">ILj</a></h1>
                <h1 id="테마2">"Programming is Life"</h1>
                <h3 id="테마3"><a href="<?php echo htmlspecialchars("login.php");?>">로그인</a></h3>
                <h3 id="테마4"  >&nbsp/</h3>
                <h3 id="테마4"><a href="<?php echo htmlspecialchars("member_form.php");?>">&nbsp회원가입</a></h3>
                <h3 id="테마4"  >&nbsp/</h3>
                <h3 id="테마4"><a href=""<?php echo htmlspecialchars("a.php");?>">&nbsp다운로드</a></h3>

            </div>

            <?php

        }

   else {


        ?>
       <meta name="viewport" content="width=device-width,initial-scale=1">
       <div class="container">
           <h1 id="테마"><a href="main.php">ILj</a></h1>
           <h1 id="테마2">"Programming is Life"&nbsp</h1>
          <?php echo $_SESSION["user"]."님"; ?>
           <h3 id="테마4"  >&nbsp/</h3>
           <?php
           if ($_SESSION["point"]==null){
               echo "보유하신 포인트가 없습니다";
           }
           else
                echo $_SESSION["point"]."원"; ?>
           <h3 id="테마4"  >&nbsp/</h3>
           <h3 id="테마4"><a href="<?php echo htmlspecialchars("logout.php");?>">&nbsp로그아웃</a></h3>
           <h3 id="테마4"  >&nbsp/</h3>
           <h3 id="테마4"><a href="<?php echo htmlspecialchars("logout.php");?>">&nbsp다운로드</a></h3>


       </div>

<?php
   }

?>


<!-- Navigation (Stays on Top) -->

<div class="center">
    <div class="center2">
    <a href="<?php echo htmlspecialchars("logout.php");?>" class="테마4">상점</a>
    <ul></ul>
    <a href="<?php echo htmlspecialchars("logout.php");?>" class="테마4">신규 게임 및 이벤트</a>
    <ul></ul>
    <a href="<?php echo htmlspecialchars("logout.php");?>" class="테마4">뉴스</a>
    <ul></ul>

        <a href="<?php echo htmlspecialchars("logout.php");?>" class="테마4">채팅</a>
        <ul></ul>
        <a href="<?php echo htmlspecialchars("logout.php");?>" class="테마4">고객센터</a>
</div>
</div>













