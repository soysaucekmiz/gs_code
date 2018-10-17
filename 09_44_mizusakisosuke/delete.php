<?php
include "funcs.php";

// GETデータ取得
$bm_id = $_GET["id"];

// DB接続
$pdo = db_connect();

// bm DELETE処理
$sqlBmDelete = "DELETE FROM gs_bm_table WHERE id=:id";
$stmtBmDelete = $pdo->prepare($sqlBmDelete);
$stmtBmDelete->bindValue(":id", $bm_id, PDO::PARAM_INT);
$statusBmDelete = $stmtBmDelete->execute();

// gs_bmtag_bindのidを取得（一旦外で書く？）
$sqlBindSearch = "SELECT * FROM gs_bmtag_bind WHERE bm_id =".$bm_id;
$stmtBindSearch = $pdo->prepare($sqlBindSearch);
$statusBindSearch = $stmtBindSearch->execute();
if($statusBindSearch==false){
    sqlError($stmtBindSearch);
}else{
    $bind_ids = array();
    while($resultBindSearch = $stmtBindSearch->fetch(PDO::FETCH_ASSOC)){
        $bind_ids[] = $resultBindSearch["id"];
    }
}

// 実行
if($statusBmDelete==false){
    sqlError($stmtBmDelete);
}else{
    if($statusBindSearch===false){
        // echo "タグはありませんでした。";
    }else{
        foreach($bind_ids as $bind_id){
            $sqlBindDelete = "DELETE FROM gs_bmtag_bind WHERE id = :bind_id";
            $stmtBindDelete = $pdo->prepare($sqlBindDelete);
            $stmtBindDelete->bindValue(":bind_id", $bind_id, PDO::PARAM_INT);
            $statusBindDelete = $stmtBindDelete->execute();
            echo "bind_id: ".$bind_id." を削除しました。";
        }
    }
}

header("Location: select.php");


?>