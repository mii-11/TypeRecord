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
    <title>type record</title>
</head>
<body>
    <div class="AllWrapper">
        <!-- ヘッダー領域 -->
        <?php include "index_menu.php" ?>
        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <h1>ログイン</h1>
                <form class="form1" action="st_top.php" method="post">
                    クラス　　：
                    <label ><input type="radio" name="user_class" value="A" required>Aクラス</label>
                    <label ><input type="radio" name="user_class" value="B">Bクラス</label>
                    <label ><input type="radio" name="user_class" value="C">Cクラス</label>
                    <label ><input type="radio" name="user_class" value="D">Ｄクラス</label>
                    <label ><input type="radio" name="user_class" value="T">先生</label>
                    <br>
                    出席番号　：<select name="user_no" required>
                    <?php
                    for($i= 1 ; $i <=30 ; $i++ ){
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                    </select>
                    <br>パスワード：<input type="text" name="user_pass" required><br>
                    <input type="submit" value="ログイン" class="rg">
                </form>
                
                <section>
                    <h1>初めての方は新規ユーザー登録をしましょう!</h1>
                    <div id="fix_header"><a href="new.php">新規登録</a></div>
                </section>


            </div>
            <!-- メイン領域終わり -->
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>    


</body>
</html>