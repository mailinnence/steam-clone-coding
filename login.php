<!--
*비밀번호 틀릴시 슬립
*3번 틀릴시 15분대기
*폼값 값입력 검사
*모든 변수 htmlspecialchar()
*동적 파라미터 sql 인젝션 보안

*이미 로그인 되어 있다면 이 페이지는 접속 불가능하게 하라

-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">


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


    if( isset( $_POST[ 'Login' ] ) && empty ($_POST['username']) && empty ($_POST['password']) ) {

    echo"<script>alert('아이디를 입력해주세요')</script>";

    }


    else if( isset( $_POST[ 'Login' ] ) && isset ($_POST['username']) && isset ($_POST['password']) ) {
        // Check Anti-CSRF token
        checkToken($_REQUEST['user_token'], $_SESSION['session_token']);

        // Sanitise username input
        $user = $_POST[ 'username' ];
        $user= htmlspecialchars($user, ENT_QUOTES, "UTF-8");
        $user = stripslashes( $user );



        // Sanitise password input
        $pass = $_POST[ 'password' ];
        $pass= htmlspecialchars($pass, ENT_QUOTES, "UTF-8");
        $pass = stripslashes( $pass );
        $pass = hash("sha256", $pass);

        // Default values
        $total_failed_login = 3;
        $lockout_time       = 15;
        $account_locked     = false;

        // Check the database (Check user information)
        $data = $con->prepare( 'SELECT failed_login, last_login FROM users WHERE user = (:user) LIMIT 1;' );
        $data->bindParam( ':user', $user, PDO::PARAM_STR );
        $data->execute();
        $row = $data->fetch();

        // Check to see if the user has been locked out.
        if( ( $data->rowCount() == 1 ) && ( $row[ 'failed_login' ] >= $total_failed_login ) )  {

            $last_login = strtotime( $row[ 'last_login' ] );
            $timeout    = $last_login + ($lockout_time * 60);
            $timenow    = time();

            // Check to see if enough time has passed, if it hasn't locked the account
            if( $timenow < $timeout ) {
                $account_locked = true;

            }
        }

        // Check the database (if username matches the password)
        $data = $con->prepare( 'SELECT * FROM users WHERE user = (:user) AND password = (:password) LIMIT 1;' );
        $data->bindParam( ':user', $user, PDO::PARAM_STR);
        $data->bindParam( ':password', $pass, PDO::PARAM_STR );
        $data->execute();
        $row = $data->fetch();


        // If its a valid login...
       if( ( $data->rowCount() == 1 ) && ( $account_locked == false ) ) {
            // Get users details
            $failed_login = $row[ 'failed_login' ];
            $last_login   = $row[ 'last_login' ];


            // Login successful
            if($k==0) {
                session_start();
                $_SESSION["user"] = $row["user"];
                $_SESSION["point"] = $row["point"];
                echo("
              <script>
                location.href = 'main.php';
              </script>");

            }
            else{
                echo "<h1>There is a problem with the token</h1>";
            }

            // Had the account been locked out since last login?
            //공격으로 인한 락킹 시간이 지나고 로그인 성공시 경고창
            if( $failed_login > $total_failed_login ) {
                echo "<h1><p>Warning: Someone might of been brute forcing your account.</p></h1>";
                echo "<h1><p>Number of login attempts: {$failed_login}.<br />Last login attempt was at: ${last_login}.</p></h1>";
            }

            // Reset bad login count
            //로그인 성공시 failed_login 초기화
            $data = $con->prepare( 'UPDATE users SET failed_login = "0" WHERE user = (:user) LIMIT 1;' );
            $data->bindParam( ':user', $user, PDO::PARAM_STR );
            $data->execute();

        } else{
            // Login failed
            // 아이디가 틀렸을때
            if($k==0) {
                sleep( rand( 0, 5 ) );

                $sql =$con->prepare("select * from users where user=(:user);");
                $sql->bindParam( ':user', $user, PDO::PARAM_STR);
                $sql->execute();
                $row = $sql->fetch();

                $sql1 =$con->prepare("select * from users where  password = (:password);");
                $sql1->bindParam( ':password', $pass, PDO::PARAM_STR);
                $sql1->execute();
                $row1 = $sql1->fetch();

               if ($sql->rowCount()!=1) {
                    echo("
                    <script>
                    window.alert('등록되지 않은 아이디입니다!');
            
                   </script>
                   ");
                   }

               if ($sql->rowCount()==1 && $sql1->rowCount()!=1) {
                    echo("
                    <script>
                    window.alert('비밀번호가 틀렸습니다');
              
                   </script>
                   ");
                }

            }
            else
                echo "<h1>There is a problem with the token</h1>";


            if ( $account_locked == 1) {
                //bool은 false == 0, true == 1 로 계산한다
                echo "<script>alert('5번 이상 로그인이 실패하였습니다. 일정 시간 이후에 다시 시도해 주시기 바랍니다')</script>";
            }

            // Update bad login count
            //로그인 실패시 failed_login +1
            $data = $con->prepare( 'UPDATE users SET failed_login = (failed_login + 1) WHERE user = (:user) LIMIT 1;' );
            $data->bindParam( ':user', $user, PDO::PARAM_STR );
            $data->execute();

        }

        // Set the last login time
        //다 기다렸다면 last_login 초기화
        $data = $con->prepare( 'UPDATE users SET last_login = now() WHERE user = (:user) LIMIT 1;' );
        $data->bindParam( ':user', $user, PDO::PARAM_STR );
        $data->execute();
    }

    // Generate Anti-CSRF token
    generateSessionToken();

    ?>

<style>
    table, th, td {
    border: 0px solid #282828;
    }
</style>
</head>
<body id="body">


<div id="body2">


    <table >
        <?php


            include "login_form.php";

        ?>


            <td><img src="img/로그인.png" width="500px", height="300px"></td>
            <td><img src="img/로그인2.png" width="500px", height="300px"></td>
        </tr>
        <tr>
            <td width="500px"></td>
            <td><img src="img/로그인3.png" width="500px", height="300px"></td>
            <td><img src="img/로그인4.png" width="500px", height="300px"></td>
        </tr>
    </table>





</body>
</html>


<!--
서비스 시에는 꼭 이런 거 지워라
update users set failed_login=0;
update users set  last_login=0;
-->