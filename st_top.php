<?php
session_start();
if (!isset($_SESSION["user_class"]) and !isset($_POST["user_class"])) {
    header("location:index.php");
    exit();
}

include_once "f1.php";

if (isset($_SESSION["user_class"])) {
    if ($_SESSION["user_class"] == "T") {
        header("location:T_top.php");
        exit();
    }
}
if (isset($_POST["user_class"])) {
    if ($_POST["user_class"] == "T") {
        $_SESSION["user_class"] = $_POST["user_class"];
        $_SESSION["user_no"] = $_POST["user_no"];
        $_SESSION["user_name"] = $_POST["user_name"];
        $_SESSION["user_pass"] = $_POST["user_pass"];
        header("location:T_top.php");
        exit();
    }
}

if (isset($_POST['user_no'])) {
    $user = $_POST;
    $SqlCall = new SQL();
    $result = $SqlCall->select($user);
    if ($result) {
        if (password_verify($user["user_pass"], $result["pw"])) {
            $_SESSION["user_class"] = $result["class"];
            $_SESSION["user_no"] = $result["no"];
            $_SESSION["user_name"] = $result["name"];
        } else {
            header("location:login_failure.php");
            exit();
        }
    } else {
        header("location:login_failure.php");
        exit();
    }
} elseif (isset($_SESSION['user_no'])) {
    $user = $_SESSION;
    $SqlCall = new SQL();
    $result = $SqlCall->select($user);
}

$result2 = $SqlCall->Bpattern($user);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>学生用トップ</title>
</head>

<body>
    <div class="AllWrapper">
        <?php include "login_menu.php" ?>

        <!--メイン領域-->
        <div class="Wrapper">
            <div id="main">
                <h1><?php echo $_SESSION["user_name"] ?>さんログイン中</h1>
                <?php

                if (isset($result2["Tpattern"])) {
                    echo "<br><p>前回挑戦したのは・・・パターン　";
                    echo $result2["Tpattern"] . "</p>";
                }

                ?>

                <h2 id="go">let's go!</h2>
                <p id="info">終わったら今日の記録を登録しましょう。</p>
                <form action="st_regist.php" method="post">
                    日付<br><input type="date" name="Tdate" value="<?php echo date('Y-m-d'); ?>"><br>
                    パターン<br><input type="text" name="Tpattern"><br>
                    タイピング数<br><input type="number" name="Tcount" min="0"><br>
                    <input type="submit" value="登録" class="rg">
                </form>
            </div>
        </div>
        <footer>
            <p>&copy;yuko</p>
        </footer>
    </div>


</body>

</html>