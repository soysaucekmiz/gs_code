<?php
session_start();

//共通関数の呼び出し
include("funcs.php");
chkSsid();

//1. POSTデータ取得
$book = $_POST["book"];
$author = $_POST["author"];
$category = $_POST["category"];
$summary = $_POST["summary"];
$comment = $_POST["comment"];
$user_id = $_SESSION["id"];

//2. DB接続
$pdo = db_connect();

//3. データ登録SQL作成
$sql = "INSERT INTO gs_bm_table (book,author,datetime,category,summary,comment,user_id) VALUES(:book,:author,sysdate(),:category,:summary,:comment,:user_id)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':book', $book, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute();
$bm_id = $pdo->lastInsertId();

// gs_bmtag_table.tag_nameに、$categoryと同値があるかを確認 ※ ※ ※
$sqlTagSearch = "SELECT * FROM gs_bmtag_table WHERE tag_name = '".$category."'";
$stmtTagSearch = $pdo->prepare($sqlTagSearch);
$statusTagSearch = $stmtTagSearch->execute();
$tagSearch = $stmtTagSearch->fetch(PDO::FETCH_ASSOC);
$tag_id = $tagSearch["id"];

$view = "";
$categoryLen = strlen($category);

if($statusTagSearch == false){
    sqlError($stmtTagSearch);
    $view = "SQLエラー";

}else if($categoryLen==0){
    // カテゴリが未入力の場合
    header("Location: index.php");
    exit;

}else if($tagSearch===false){
    // gs_bmtag_tableに該当する値が存在しない場合
    $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
    $stmtTagInsert = $pdo->prepare($sqlTagInsert);
    $stmtTagInsert->bindValue(':tag_name', $category, PDO::PARAM_STR);
    $statusTagInsert = $stmtTagInsert->execute();
    $tag_id = $pdo->lastInsertId();

    $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
    $stmtBindInsert = $pdo->prepare($sqlBindInsert);
    $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
    $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
    $statusBindInsert = $stmtBindInsert->execute();
    header("Location: index.php");
    exit;

}else{
    // gs_bmtag_tableに該当する値が存在する場合
    $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
    $stmtBindInsert = $pdo->prepare($sqlBindInsert);
    $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
    $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
    $statusBindInsert = $stmtBindInsert->execute();
    header("Location: index.php");
    exit;

}

?>