<?php
include "funcs.php";

// GETデータ取得
$id = $_GET["id"];

// DB接続
$pdo = db_connect();

// bm DELETE処理
$sqlBmDelete = "DELETE FROM gs_bm_table WHERE id=:id";
$stmtBmDelete = $pdo->prepare($sqlBmDelete);
$stmtBmDelete->bindValue(":id", $id, PDO::PARAM_INT);
$statusBmDelete = $stmtBmDelete->execute();

// gs_bmtag_bindのidを取得（一旦外で書く？）
$sqlBindSearch = "SELECT * FROM gs_bmtag_bind WHERE bm_id =".$id;
$stmtBindSearch = $pdo->prepare($sqlBindSearch);
$statusBindSearch = $stmtBindSearch->execute();
$bindSearch = $stmtBindSearch->fetch(PDO::FETCH_ASSOC);
$bind_id = $bindSearch["id"];

// 実行
if($statusBmDelete==false){
    sqlError($stmtBmDelete);
}else{
    if($bindSearch===false){
        echo "タグはありませんでした。";
    }else{
        $sqlBindDelete = "DELETE FROM gs_bmtag_bind WHERE id=:id";
        $stmtBindDelete = $pdo->prepare($sqlBindDelete);
        $stmtBindDelete->bindValue(":id", $bind_id, PDO::PARAM_INT);
        $statusBindDelete = $stmtBindDelete->execute();
        echo "旧タグ k -> 新タグ NULL";
    }
    echo "削除されました。";
}

?>