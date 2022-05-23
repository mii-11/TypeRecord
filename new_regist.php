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
    <title>登録</title>
</head>

<body>
    <div class="AllWrapper">
        <!-- ヘッダー領域 -->
        <?php include "index_menu.php" ?>
        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <?php
                $user = $_POST;
                $SqlCall = new SQL();
                $result = $SqlCall->select($user);

                if ($result) {
                    echo "<h1>すでに同じIDがあります。</h1><div id='fix_header'><ul><li><a href='new.php'>新規ユーザー登録へ</a></li></ul></div>";
                } else {
                    $result = $SqlCall->NewUser($user);
                    if ($result) {
                        $_SESSION["user_class"] = $_POST["user_class"];
                        $_SESSION["user_no"] = $_POST["user_no"];
                        $_SESSION["user_name"] = $_POST["user_name"];
                        $_SESSION["user_pass"] = $_POST["user_pass"];

                        echo "<h1>登録完了！</h1>
                                <p>ログインをしましょう！</p>
                                <br><a href='st_top.php'>このままログインする</a>";
                    } else {
                        echo "<h1>登録できませんでした。</h1>
                                    <P>2回試しても登録できなかったら、先生に相談しましょう。</P>";
                    }
                }
                ?>


            </div>
            <!-- メイン領域終わり -->
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>


</body>

</html>