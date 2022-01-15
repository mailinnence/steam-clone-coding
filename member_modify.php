<!--
보안
모든 인젝션 공격 차단    o
비밀번호 sha()         o
csrf 토큰             o
captcha


*이 페이지로 바로 접근 못하도록 하라

-->

<?php


include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\1-0.token.php";
include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\0.db_info.php";


$user = htmlspecialchars($_POST["user"]);

$sql = $con->prepare("select * from users where user=(:user);");
$sql->bindParam(':user', $user, PDO::PARAM_STR);
$sql->execute();
$row = $sql->fetch();


if (!$user ) {

    echo("
              <script>
                location.href = 'login.php';
              </script>
           ");
    exit;
}



if ($_POST["user_token"]) {

    checkToken($_REQUEST['user_token'], $_SESSION['session_token']);

    if ($k == 0) {
        $user = htmlspecialchars($_POST["user"]);

        $password = htmlspecialchars($_POST["password"]);
        $password = hash("sha256", $password);

        $password1 = htmlspecialchars($_POST["password1"]);
        $password1 = hash("sha256", $password1);

        $pass_confirm = htmlspecialchars($_POST["pass_confirm"]);
        $pass_confirm = hash("sha256", $pass_confirm);

        $age = htmlspecialchars($_POST["age"]);
        $name = htmlspecialchars($_POST["name"]);
        $email1 = htmlspecialchars($_POST["email1"]);
        $email2 = htmlspecialchars($_POST["email2"]);
        $email = $email1 . "@" . $email2;

        $gender = htmlspecialchars($_POST["gender"]);
        $num2 = htmlspecialchars($_POST["num2"]);
        $num3 = htmlspecialchars($_POST["num3"]);

        $num = "010" . $num2 . $num3;
        $sql = $con->prepare("select password from users where password = (:password);");
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->execute();

        $c1 = 0;

        if ($sql->rowCount() != 1) {
            echo("
              <script>
                window.alert('입력하신 현재 비밀번호가 맞지 않습니다.')
                history.go(-1)
              </script>
           ");
            $c1 = 1;
        }

        if ($password1 == $pass_confirm) {

            $sql = $con->prepare("update users set password=:password1, name=:name, gender=:gender, phone_num=:num , address=:email, age=:age where user=:user;");


            $sql->bindParam(':password1', $password1, PDO::PARAM_STR);
            $sql->bindParam(':name', $name, PDO::PARAM_STR);
            $sql->bindParam(':gender', $gender, PDO::PARAM_STR);
            $sql->bindParam(':num', $num, PDO::PARAM_STR);
            $sql->bindParam(':email', $email, PDO::PARAM_STR);
            $sql->bindParam(':age', $age, PDO::PARAM_STR);


            $sql->execute();


            $con = null;

            if ($c1 == 0) {
            //    echo("<script>window.alert('정보수정이 완료되었습니다 완료되었습니다')</script>");
                echo "<script>location.href = 'main.php';</script>";}}

    else{
        echo("
              <script>
                window.alert('바꿀 비밀번호 확인이 맞지 않습니다다')
               history.go(-1)
              </script>
           ");

    }



    }




    else
        echo "<h1>There is token prblem</h1>";


}


?>
