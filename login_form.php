


<tr>
    <td>
        <div class="왼쪽배치">
            <script>check_input();</script>
            <form action="<?php echo htmlspecialchars("login.php");?>" method="POST">
                <h2  style="color: white;">Login</h2>
                <div style="color: white;">Username:<br /></div>
                <input type="text" name="username"><br />
                <div style="color: white;">Password:<br /></div>
                <input type="password" AUTOCOMPLETE="off" name="password"><br />
                <br />
                <input type="submit" value="Login" name="Login" >
                <?php echo tokenField();?>
                <a href="<?php echo htmlspecialchars("loss_myid.php");?>">비밀번호 분실시 클릭</a>
            </form>
            <br /><br />
        </div>


</td>


