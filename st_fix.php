<?php
session_start();
include_once "f1.php";
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>記録</title>
</head>
<body>
    <div class="AllWrapper">
        <?php include "login_menu.php" ?>
        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <!-- <h1>修正画面</h1> -->
                <?php
                $user = $_SESSION;
                $POST = $_POST;
                $SqlCall = new SQL();
                $result = $SqlCall->Update($user, $POST);
                echo $result;
                ?>
                <div id="fix_header">
                    <ul>
                        <li><a href="st_top.php">学生トップ</a></li>
                        <li><a href="st_graph.php">タイピング記録</a></li>
                        <li><a href="st_logout.php">ログアウトする</a></li>
                    </ul>
                </div>
            </div>
            <!-- メイン領域終わり -->
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>
</body>
</html>