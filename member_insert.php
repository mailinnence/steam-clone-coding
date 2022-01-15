<!--
보안
모든 인젝션 공격 차단    o
비밀번호 sha()         o
csrf 토큰             o
captcha


개선점
미래에 태어나게 할 수 도 있다
*이미 로그인 되어 있다면 이 페이지는 접속 불가능하게 하라

-->

<?php


    include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\1-0.token.php";
    include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\0.db_info.php";


    $user = htmlspecialchars($_POST["user"]);

    $sql = $con->prepare("select * from users where user=(:user);");
    $sql->bindParam(':user', $user, PDO::PARAM_STR);
    $sql->execute();

    $row = $sql->fetch();
    $db_pass = $row["user"];
if (!$user ) {

    echo("
              <script>
                location.href = 'member_form.php';
              </script>
           ");
    exit;
}


    if ($user == $db_pass) {

        echo("
              <script>
                window.alert('동일한 아이디가 있습니다. 중복확인을 꼭 확인해주세요')
                history.go(-1)
              </script>
           ");
        exit;
    }



if ($_POST["user_token"]) {

    checkToken($_REQUEST['user_token'], $_SESSION['session_token']);

    if ($k == 0) {

        $password = htmlspecialchars($_POST["password"]);
        $password = hash("sha256", $password);
        $age = htmlspecialchars($_POST["age"]);
        $name = htmlspecialchars($_POST["name"]);
        $email1 = htmlspecialchars($_POST["email1"]);
        $email2 = htmlspecialchars($_POST["email2"]);
        $email = $email1 . "@" . $email2;

        $gender = htmlspecialchars($_POST["gender"]);
        $num2 = htmlspecialchars($_POST["num2"]);
        $num3 = htmlspecialchars($_POST["num3"]);

        $num = "010" . $num2 . $num3;

        $regist_day = date("Y-m-d");


        $sql = $con->prepare("insert into users(user, password, name, gender, phone_num , address,age, regist_day) values(:user, :password, :name,:gender,:num, :email, :age,:regist_day);");
        $sql->bindParam(':user', $user, PDO::PARAM_STR);
        $sql->bindParam(':password', $password, PDO::PARAM_STR);
        $sql->bindParam(':name', $name, PDO::PARAM_STR);
        $sql->bindParam(':gender', $gender, PDO::PARAM_STR);
        $sql->bindParam(':num', $num, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':age', $age, PDO::PARAM_STR);
        $sql->bindParam(':regist_day', $regist_day, PDO::PARAM_STR);

        $sql->execute();


        $con = null;


        echo("
              <script>
                window.alert('회원가입이 완료되었습니다')
          
              </script>
           ");


        echo "
	      <script>
	          location.href = 'login.php';
	      </script>
	  ";

    }

else
    echo "<h1>There is token prblem</h1>";


}


?>


