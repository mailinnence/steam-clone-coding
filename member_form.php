<!--
보안

*폼값 입력 유무 검사 완료
*이미 로그인 되어 있다면 이 페이지는 접속 불가능하게 하라

-->


<?php
include "C:\\xampp\\htdocs\\steam_clone_coding\\mainneber1928\\1-0.token.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>회원가입</title>


    <script>
        function check_input()
        {
            if (!document.member_form.user.value) {
                alert("아이디를 입력하세요!");
                document.member_form.user.focus();
                return;
            }

            if (!document.member_form.password.value) {
                alert("비밀번호를 입력하세요!");
                document.member_form.password.focus();
                return;
            }

            if (!document.member_form.pass_confirm.value) {
                alert("비밀번호확인을 입력하세요!");
                document.member_form.pass_confirm.focus();
                return;
            }

            if (document.member_form.password.value !=
                document.member_form.pass_confirm.value) {
                alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
                document.member_form.password.focus();
                document.member_form.password.select();
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
            window.open("member_check_id.php?user=" + document.member_form.user.value,
                "IDcheck",
                "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
        }


    </script>








</head>
<?php
include "style .html";
generateSessionToken();




?>


<body id="body">
<?php include "header.php" ;

if(isset($_SESSION["user"])){
    echo("
              <script>
                location.href = 'main.php';
              </script>
           ");
}
?>
<div id="body2">



        <form  name="member_form" method="post" action='member_insert.php'>

            <h2 style="color: white;">회원 가입</h2>
<!--아이디-->
                <div style="color: white;">아이디 (프로필이름)</div>
            <div class="container">
            <div style="color: white;"><input type="text" name="user"></div>
                &nbsp<a href="#"><img src="./img/check_id.gif" onclick="check_id()"></a>
            </div>
            <br>
<!--비밀번호-->
                <div style="color: white;">비밀번호</div>
                <div style="color: white;">
                    <input type="password" name="password">
                </div>

<!--비밀번호 확인-->


                <div style="color: white;">비밀번호 확인</div>
                <input type="password" name="pass_confirm">
            <br><br>
<!-- 이름  -->
                <div style="color: white;">이름</div>
                <input type="text" name="name">
<!--이메일-->
                <div style="color: white;">이메일</div>
                <div class="col2" style="color: white;">
                    <input type="text" name="email1" >@<input type="text" name="email2">
                    <br><br>
<!--성별-->
                    <div style="color: white;">성별</div>
                    <input type="radio" name="gender" value="남자">남자
                    <input type="radio" name="gender" value="여자">여자

                    <br><br>
<!--출생연도-->
                    <div style="color: white;">출생연도</div>
                    <div class="col2" style="color: white;">
                        <input type="date" name="age">
                        <br><br>



<!-- 전화번호 -->
                    <div style="color: white;">전화번호</div>
                <div class="col2" style="color: white;">
                    010-<input type="text" name="num2" maxlength="4">-<input type="text" name="num3" maxlength="4">
                    <br>
                    <?php echo tokenField()?>


                    <br>
            <img style="cursor:pointer" src="./img/button_save.gif" onclick="check_input()">
                    <button type="reset">리셋</button>

                <br>

       </form>




    </div>
</div>



</body>
</html>

