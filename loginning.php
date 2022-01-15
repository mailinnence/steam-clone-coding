
<?php
if($point==null){
    $point=0;
}
?>



<tr>
    <td>
        <div class="왼쪽배치">

                <h2  style="color: white;"><?php echo $user ?></h2>
                <div style="color: white;">보유중인 포인트: <?php echo $point ."원"?><br /><br /></div>
               <div style="color: white;"><a href= "<?php echo htmlspecialchars("my_game.php");?>">내 게임 바로가기</a><br /><br /></div>
                <div style="color: white;"><a href= "<?php echo htmlspecialchars("friend_list.php");?>">접속 중인 친구</a><br /><br /></div>
            <div style="color: white;"><a href= "<?php echo htmlspecialchars("member_modify_form.php");?>">프로필,회원정보 수정</a><br /><br /></div>

            <br /><br />
        </div>

    </td>
