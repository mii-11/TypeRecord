<?php
session_start();
session_unset();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ログアウト</title>
</head>

<body>
    <div class="AllWrapper">
        <!-- ヘッダー領域 -->
        <?php include "index_menu.php" ?>
        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <h1>ログアウトしました。<h1>　　　お疲れさまでした。</h1>
            </div>
            <!-- メイン領域終わり -->
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>
</body>

</html>