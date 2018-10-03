<?php
include "funcs.php";

// GETデータ取得
$id = $_GET["id"];

// DB接続
$pdo = db_connect();

// SQL DELETE処理
$sqlBmDelete = "DELETE FROM gs_bm_table WHERE id=:id";
$stmtBmDelete = $pdo->prepare($sqlBmDelete);
$stmtBmDelete->bindValue(":id", $id, PDO::PARAM_INT);
$statusBmDelete = $stmtBmDelete->execute();

// 実行
if($statusBmDelete==false){
    sqlError($stmtBmDelete);
}else{
    echo "削除されました。";
}

?>