<?php
include 'funcs.php';

//1.POSTでParamを取得
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$id = $_POST["id"];

//2.DB接続など
$pdo = db_connect();

// 3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
$update = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id";
$stmt = $pdo->prepare($update);
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR);
$stmt->bindValue(":lpw", $lpw, PDO::PARAM_INT);
$stmt->bindValue(":kanri_flg", $kanri_flg, PDO::PARAM_STR);
$stmt->bindValue(":life_flg", $life_flg, PDO::PARAM_STR);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();
header("Location: user_select.php");

?>
