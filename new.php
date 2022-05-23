<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ユーザー登録</title>
</head>

<body>
    <div class="AllWrapper">
        <!-- ヘッダー領域 -->
        <?php include "index_menu.php" ?>
        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <h1>ようこそ！</h1>
                <p>新規登録して利用を開始しましょう。</p>

                <form method="post" id="form1" action="new_regist.php">
                    クラス：
                    <label><input type="radio" name="user_class" value="A" required>Aクラス</label>
                    <label><input type="radio" name="user_class" value="B">Bクラス</label>
                    <label><input type="radio" name="user_class" value="C">Cクラス</label>
                    <label><input type="radio" name="user_class" value="D">Ｄクラス</label>
                    <label><input type="radio" name="user_class" value="T">先生</label>
                    <br>
                    出席番号：<select name="user_no" required>
                        <?php
                        for ($i = 1; $i <= 30; $i++) {
                            echo "<option value='" . $i . "'>" . $i . "</option>";
                        }
                        ?>
                    </select>
                    <br>
                    パスワード：<input type="number" name="user_pass" required placeholder="数字"><br>
                    氏名：<input type="text" name="user_name" required><br>
                    <input type="submit" value="登録する">
                </form>
            </div>
            <!-- メイン領域終わり -->
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>
</body>
</html>