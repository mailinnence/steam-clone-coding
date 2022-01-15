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

?>



<body id="body">
<div id="body2">


    <?php
    if(!$user) {
        ?>


        <?php
    }

    else {


        ?>
        <table >
            <?php


            include "loginning.php";

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

        <?php
    }

    ?>





</div>




</body>
</html>