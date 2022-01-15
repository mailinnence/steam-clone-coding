<!--
*로그인 안 되어 있다면 이 페이지는 접속 불가능하게 하라


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
generateSessionToken();


?>

<script>
    function check_input()
    {
        if (!document.member_form.user.value) {
            alert("아이디를 입력하세요!");
            document.member_form.user.focus();
            return;
        }

        if (!document.member_form.password.value) {
            alert("현재 비밀번호를 입력하세요!");
            document.member_form.password.focus();
            return;
        }


        if (!document.member_form.password1.value) {
            alert("바꿀 비밀번호를 입력하세요!");
            document.member_form.password1.focus();
            return;
        }

        if (!document.member_form.pass_confirm.value) {
            alert("바꿀 비밀번호확인을 입력하세요!");
            document.member_form.pass_confirm.focus();
            return;
        }

        if (document.member_form.password1.value !=
            document.member_form.pass_confirm.value) {
            alert("바꿀 비밀번호와 바뀔 비밀번호 확인이 같지 않습니다.\n다시 입력해 주세요!");
            document.member_form.pass_confirm.focus();
            document.member_form.pass_confirm.select();
            return;
        }

        if (!document.member_form.name.value) {
            alert("이름을 입력하세요!");
            document.member_form.name.focus();
            return;
        }

        if (!document.member_form.email1.value) {
            alert("이메일 주소를 입력하세요!");
            document.member_form.email1.focus();
            return;
        }

        if (!document.member_form.email2.value) {
            alert("이메일 주소를 입력하세요!");
            document.member_form.email2.focus();
            return;
        }

        if (!document.member_form.gender.value) {
            alert("성별을 선택해주세요");
            document.member_form.gender.focus();
            return;
        }

        if (!document.member_form.age.value) {
            alert("생일을 선택해주세요");
            document.member_form.age.focus();
            return;
        }


        if (!document.member_form.num2.value ) {
            alert("전화번호를 입력해주세요");
            document.member_form.num2.focus();
            return;
        }

        if (isNaN(document.member_form.num2.value )==true) {
            alert("전화번호를 숫자를 입력해주세요");
            document.member_form.num2.values="";
            document.member_form.num2.focus();
            return;
        }



        if (!document.member_form.num3.value) {
            alert("전화번호를 입력해주세요");
            document.member_form.num3.focus();
            return;
        }


        if (isNaN(document.member_form.num3.value )==true) {
            alert("전화번호를 숫자를 입력해주세요");
            document.member_form.num3.values="";
            document.member_form.num3.focus();
            return;
        }



        document.member_form.submit();
    }




    function check_id() {
        window.open("member_modify_check_id.php?user=" + document.member_form.user.value,
            "IDcheck",
            "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
    }


</script>


<body id="body">
<div id="body2">


    <?php
    if(!$user) {

            echo("
              <script>
                location.href = 'login.php';
              </script>
           ");



        ?>


        <?php
    }



    else {

    $sql =$con->prepare("select * from users where user=(:user);");
    $sql->bindParam( ':user', $user, PDO::PARAM_STR);
    $sql->execute();
    $row = $sql->fetch();


    $user=$row["user"];
    $name=$row["name"];
    $address=$row["address"];

    $octet = explode( "@", $address );
    $address1=$octet[0];
    $address2=$octet[1];
    $age=$row["age"];
    $gender=$row["gender"];
    $phone_num=$row["phone_num"];
    $phone_num1=$phone_num[3].$phone_num[4].$phone_num[5].$phone_num[6];
    $phone_num2=$phone_num[7].$phone_num[8].$phone_num[9].$phone_num[10];


    ?>






    <form  name="member_form" method="post" action='member_modify.php'>

        <h2 style="color: white;">회원정보 수정</h2>
        <!--아이디-->
        <div style="color: white;">아이디 (프로필이름)</div>
        <div class="container">
            <div style="color: white;"><input type="text" name="user" value="<?=$user?>"></div>
            &nbsp<a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
        </div>
        <br>
        <!--비밀번호-->
        <div style="color: white;">현재 비밀번호</div>
        <div style="color: white;">
            <input type="password" name="password">
        </div>


        <div style="color: white;">바꿀 비밀번호</div>
        <div style="color: white;">
            <input type="password" name="password1">
        </div>


        <!--비밀번호 확인-->


        <div style="color: white;">바꿀 비밀번호 확인</div>
        <input type="password" name="pass_confirm">
        <br><br>

        <!-- 이름  -->
        <div style="color: white;">이름</div>
        <input type="text" name="name" value="<?=$name?>">

        <!--이메일-->
        <div style="color: white;">이메일</div>
        <div class="col2" style="color: white;">
            <input type="text" name="email1" value="<?=$address1?>">@<input type="text" name="email2" value="<?=$address2?>">

            <br><br>
            <!--성별-->
            <div style="color: white;">성별</div>
            <input type="radio" name="gender" value="남자" <?php if($gender=="남자"){echo "checked";}?>>남자
            <input type="radio" name="gender" value="여자" <?php if($gender=="여자"){echo "checked";}?>>여자

            <br><br>
            <!--출생연도-->
            <div style="color: white;">출생연도</div>
            <div class="col2" style="color: white;">
                <input type="date" name="age" value="<?=$age?>">
                <br><br>



                <!-- 전화번호 -->
                <div style="color: white;">전화번호</div>
                <div class="col2" style="color: white;">
                    010-<input type="text" name="num2" maxlength="4" value="<?=$phone_num1?>">-<input type="text" name="num3" maxlength="4"  value="<?=$phone_num2?>">
                    <br>
                    <?php echo tokenField()?>


                    <br>
                    <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">
                    <button type="reset">리셋</button>

                    <br>

    </form>




</div>
</div>














<?php
}

?>





</div>




</body>
</html>
