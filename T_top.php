<?php
session_start();
if (!isset($_SESSION["user_class"])) {
    header("location:login_failure.php");
}
include_once "f1.php";

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.6.0.min.js"></script>
    <title>先生用トップ</title>
</head>

<body>
    <?php include "T_login_menu.php" ?>

    <!--メイン領域-->
    <div class="AllWrapper">
        <div class="wrapper">
            <div id="Ttop_main">
                <?php
                if (isset($_SESSION["user_class"])) {
                    $user = $_SESSION;
                    $SqlCall = new SQL();
                    $result = $SqlCall->select($user);

                    if ($result) {
                        if (password_verify($_SESSION["user_pass"], $result["pw"])) {
                            $_SESSION["user_name"] = $result["name"];
                        } else {
                            header("location:login_failure.php");
                            exit();
                        }
                    } else {
                        header("location:login_failure.php");
                        exit();
                    }
                }
                ?>

                <h1><?php echo $_SESSION["user_name"] ?>先生ログイン中</h1><br>
                <h2>登録チェック</h2>

                クラス：
                <label><input type="radio" id="user_class" name="user_class" value="A" required>Aクラス</label>
                <label><input type="radio" id="user_class" name="user_class" value="B">Bクラス</label>
                <label><input type="radio" id="user_class" name="user_class" value="C">Cクラス</label>
                <label><input type="radio" id="user_class" name="user_class" value="D">Ｄクラス</label>
                <br>日付：<input type="date" id="Tdate" name="Tdate" value="<?php echo date('Y-m-d'); ?>"><br>
                <button id="ajax">開始</button><br>
                <button id="tomeru" onclick="stop();">止める</button>
            </div>

            <div id="result">
                <table>
                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo '<tr><td> ' . $i . ':　<div class="' . $i . '"></div></td><td> ' . ($i + 5) . ':　<div class="' . ($i + 5) . '"></td><td>' . ($i + 10) . ':　<div class="' . ($i + 10) . '"></td><td>' . ($i + 15) . ':　<div class="' . ($i + 15) . '"></td><td>' . ($i + 20) . ':　<div class="' . ($i + 20) . '"></td><td>' . ($i + 25) . ':　<div class="' . ($i + 25) . '"></td></tr>';
                        echo '<tr><td><div class="' . $i . 'x"></div></td><td><div class="' . ($i + 5) . 'x"></td><td><div class="' . ($i + 10) . 'x"></td><td><div class="' . ($i + 15) . 'x"></td><td><div class="' . ($i + 20) . 'x"></td><td><div class="' . ($i + 25) . 'x"></td></tr>';
                    }
                    ?>
                </table>
            </div>

        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>

    </div>
</body>

</html>
<script>
    $(function() {
        let timer = "";

        $('#ajax').on('click', function() {
            clearInterval(timer);
            $("tr div").text(""); 
            let param = { 
                'class': $('[name="user_class"]:checked').val(),
                'Tdate': $('#Tdate').val()
            }
            let json_param = JSON.stringify(param); 
            let second = 1000;

            timer = setInterval(function() { 
                $.ajax({
                        type: 'POST', 
                        url: 'dbconnect.php',
                        async: true, 
                        dataType: 'json', 
                        timeout: 10000, 
                        data: json_param
                    })
                    .done(function(data) { 
                        $.each(data['list2'], function(index, val) { 
                            $('.' + val.no).text(val.name);
                        });
                        $.each(data['list3'], function(index, val) { 
                            $('.' + val.no + 'x').text(val.Tcount);
                        });
                    })
                    .fail(function() { 
                        console.log('通信失敗');
                    })
                    .always(function() {
                    });

            }, second);
        });
        $('#tomeru').on('click', function() {
            clearInterval(timer);
        });
    });
</script>