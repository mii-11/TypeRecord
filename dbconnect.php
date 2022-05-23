<?php
include_once "f1.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$SqlCall = new SQL();
$list['list2'] = $SqlCall->Dbconnect1($data);
$list['list3'] = $SqlCall->Dbconnect2($data);

    header('Content-type: application/json');
    echo json_encode($list,JSON_UNESCAPED_UNICODE);



?>