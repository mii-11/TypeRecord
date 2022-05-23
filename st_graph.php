<?php
session_start();
include_once "f1.php";
if (!isset($_SESSION)) {
  header("location:index.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>グラフ</title>
</head>

<body>
  <div class="AllWrapper">
    <?php include "login_menu.php" ?>

    <!--メイン領域-->
    <div class="Wrapper">
      <div id="main">
        <!-- <h1>グラフ画面</h1> -->
        <div>
          <canvas id="myChart" width="600" height="400"></canvas>
        </div>
        <?php

        $user = $_SESSION;
        $SqlCall = new SQL();
        $result = $SqlCall->record($user);
        if (isset($result)) {
          echo "<br><h1 id='graph_h1'>これまでの記録</h1>";

          $i = 0;
          echo "<table><tr><th>日付</th><th>タイピング数</th><th>日付</th><th>タイピング数</th><th>日付</th><th>タイピング数</th><th>日付</th><th>タイピング数</th></tr><tr>";
          foreach ($result as $key => $value) {
            $tuki = substr($value["Tdate"], 5, 2);
            $hi = substr($value["Tdate"], 8, 2);
            echo "<td>" . $tuki . "/" . $hi . "</td><td id='count'>" . number_format($value["Tcount"]) . "</td>";
            if ($i % 4 == 3) {
              echo "</tr><tr>";
            }
            $i++;
          }
          $count = 4 - ($i % 4);
          echo str_repeat("<td></td><td id='count'></td>", $count);
          echo "</tr></table><br>";
        }
        ?>
        <p class="topButton">⇧</p>

      </div>
      <!-- メイン領域終わり -->
    </div>
    <footer>
      <p>&copy;yuko</p>
    </footer>
  </div>


</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="jquery-3.6.0.min.js"></script>

<script>
  const labels = [
    <?php
    if (isset($result)) {
      foreach ($result as $value) { 
        $tuki = substr($value["Tdate"], 5, 2);
        $hi = substr($value["Tdate"], 8, 2);
        echo "'" . $tuki . "/" . $hi . "',";
      }
    }
    ?>
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My Type Record',
      backgroundColor: '#FF1818',
      borderColor: '#FF1818',
      data: [<?php
              if (isset($result)) {
                foreach ($result as $value) {
                  echo $value["Tcount"] . ",";
                }
              }
              ?>],
    }]
  };

  const config = {
    type: 'line',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

  $(function() {
    var btn = $('.topButton');

    $(window).on('load scroll', function() {
      if ($(this).scrollTop() > 50) {
        btn.addClass('active');
      } else {
        btn.removeClass('active');
      }
    });

    btn.on('click', function() {
      $('body,html').animate({
        scrollTop: 0
      });
    });
  });
</script>

</html>