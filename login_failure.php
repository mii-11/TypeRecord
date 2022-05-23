<?php
    session_start();
    session_unset();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ログイン失敗</title>
</head>
<body>
    <div class="AllWrapper">
        <!-- ヘッダー領域 -->
        <?php include "index_menu.php" ?>
     <!--メイン領域-->
        <div id="main">
            <h1>ログイン出来ませんでした。</h1>
            <p>出席番号・パスワードを確認してください。</p>
            <p>2回ログインを試みても出来なかったら、先生に言いましょう。</p>
            <div id='fix_header'>
                <ul>
                    <li><a href='index.php'>ログインページへ</a></li>
                    <li><a href='new.php'>新規ユーザー登録へ</a></li>
                </ul>
            </div>

        </div>
        <!-- メイン領域終わり -->
    </div>
    <footer>
        <p>&copy;yuko</p>
    </footer>
</body>
</html>