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
                <?php
                    $user = $_SESSION;
                    $SqlCall = new SQL();
                    $result = $SqlCall -> record($user);

                    if(isset($_POST["fix"])){
                            $wrong = true;
                            foreach($result as $value){
                                if($value["Tdate"] == $_POST["Tdate"]){
                                    $wrong = false;
                                    break ;
                                }
                            }
                    }

                    if ( isset($_POST["Tdate"])){
                        $wrong = true;
                        foreach($result as $value){
                            if($value["Tdate"] == $_POST["Tdate"]){
                                echo <<< EOS
                                <h1>この日は既に登録されています。</h1><br>タイプ数を修正する場合は下記にもう一度入力してください。<br><br>
                                <form action="st_fix.php" method="post" name="fix">
                                日付　　　　：{$value["Tdate"]}<br><input type="hidden" name="Tdate" value="{$value["Tdate"]}">
                                パターン　　：<input type="text" name="Tpattern" ><br>
                                タイピング数：<input type="number" name="Tcount"min="0"><br>
                                <br><input type="submit" value="修正する">
                                </form>
                            EOS;
                                $wrong = false;
                                break ;
                            }
                        }
                        if( $wrong){
                            $POST = $_POST;
                            $insert = $SqlCall -> TodayRecord($user,$POST);
                
                                    echo $insert;
                                    include_once "button.php";
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