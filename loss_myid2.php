<!--
아이디 잃어버렸을때
*값을 받는 변수에 인젝션 보안
*-htmlspecialchars()
*-동적 파라미터

*이미 로그인 되어 있다면 이 페이지는 접속 불가능하게 하라

*유저토큰
캡챠 추가 할것!
백엔드 개발때 메일 휴대폰 전송도 한번 알아볼것
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>민우의 상점사점</title>

</head>

<?php
include "style .html";
include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\0.db_info.php";
include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\1-0.token.php";
include "header.php";


if(isset($_SESSION["user"])){
    echo("
              <script>
                location.href = 'main.php';
              </script>
           ");
}



if(isset( $_POST[ 'Login' ] ) && isset($_POST["username"])) {
    $c1=0;
    checkToken($_REQUEST['user_token'], $_SESSION['session_token']);

    if($k==0) {
        $user = $_POST["username"];
        $user = htmlspecialchars($user);
        $sql = $con->prepare("select * from users where address=(:user);");
        $sql->bindParam(':user', $user, PDO::PARAM_STR);
        $sql->execute();
        $row = $sql->fetch();

        if ($sql->rowCount() == 1) {
            $c1 = 1;
            echo "<script>alert('해당 이메일로 입시 비밀번호가 발송 되었습니다')</script>";

        }


        $user = $_POST["username"];
        $user = htmlspecialchars($user);
        $sql = $con->prepare("select * from users where phone_num=(:user);");
        $sql->bindParam(':user', $user, PDO::PARAM_STR);
        $sql->execute();
        $row = $sql->fetch();


        if (($sql->rowCount() == 1)) {
            $c1 = 1;
            echo "<script>alert('해당 번호로 입시 비밀번호가 발송 되었습니다')</script>";
        }

        if ($c1 == 0) {
            echo "<script>alert('해당 이메일 또는 번호가 없습니다')</script>";

        }
    }

    else{
        echo "<h1>There is a problem with the token</h1>";
    }




}


generateSessionToken();
?>

<body id="body">
<div id="body2">

    <table >
        <tr>
            <td>
                <div class="왼쪽배치">
                    <script>check_input();</script>
                    <form action= "<?php echo htmlspecialchars("loss_myid2.php");?>" method="POST">
                        <h2  style="color: white;">아이디 찾기<br>가입 당시 이용한 이메일이나 전화번호를<br> 적어주세요</h2>
                        <div style="color: white;">email or phone_number:<br /></div>
                        <input type="text" name="username"><br />
                        <br />
                        <input type="submit" value="Login" name="Login" >
                        <?php echo tokenField();?>
                        <a href= "<?php echo htmlspecialchars("loss_myid.php");?>">비밀번호 분실시 클릭</a>
                    </form>
                    <br /><br />
                </div>

            </td>


            <td><img src="img/로그인.png" width="500px", height="300px"></td>
            <td><img src="img/로그인2.png" width="500px", height="300px"></td>
        </tr>
        <tr>
            <td width="500px"></td>
            <td><img src="img/로그인3.png" width="500px", height="300px"></td>
            <td><img src="img/로그인4.png" width="500px", height="300px"></td>
        </tr>
    </table>


</div>




</body>
</html>