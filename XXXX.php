<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
 <?php 
  echo "INSERT INTO `db4`.`record` (`class`, `no`, `Tdate`, `Tpattern`, `Tcount`) VALUES &nbsp<br>";
  for($i = 06 ; $i <= 12 ; $i++)  {
      for($j = 01 ; $j <= 30 ; $j++){
        $m = ($j*10+85*7);
       echo "('A','1','2021-".$i."-".$j."','".$j."',".$m." ),<br>";
    }
  }
//　↓以下のようにコピペする
// INSERT INTO `db4`.`record` (`class`, `no`, `Tdate`, `Tpattern`, `Tcount`) VALUES 
// ('A','1','2021-10-1','1',605 ),
// ('A','1','2021-10-2','2',615 ),
// ('A','1','2021-10-3','3',625 ) 　←最後カンマを消す
?>   
</body>
</html>

