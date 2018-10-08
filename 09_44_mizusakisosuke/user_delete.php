<?php
include 'funcs.php';

// GETで変数取得
$id = $_GET["id"];

// DB接続
$pdo = db_connect();

// SQL処理
$sql = "DELETE FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 実行
if($status==false){
    sqlError($stmt);
}else{
    header('Location: user_select.php');
    exit;
}

?>