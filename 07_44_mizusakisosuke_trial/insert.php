<?php
//共通関数の呼び出し
include("funcs.php");

//1. POSTデータ取得
$book = $_POST["book"];
$author = $_POST["author"];
$category = $_POST["category"];
$summary = $_POST["summary"];
$comment = $_POST["comment"];


//2. DB接続
$pdo = db_connect();

// gs_bmtag_tableから$categoryに合致するを取得
$sqlTag = "SELECT * FROM gs_bmtag_table WHERE tag_name = '".$category."'";
$stmtTag = $pdo->prepare($sqlTag);
$statusTag = $stmtTag->execute();
var_dump($category);
var_dump($statusTag);


// gs_bm_tableの次回IDを取得
// $sqlBm = "SHOW TABLE STATUS LIKE 'gs_bm_table'";

// $sqlBm = "SELECT * FROM 'gs_bm_table'";
// $stmtBm = $pdo->prepare($sqlBm);

// $row = mysql_fetch_object($stmtBm); // 非推奨とのこと
// $result = $stmtBm->fetch(PDO::FETCH_OBJ);
// $nextId = $result->Auto_increment();
// $nextId = $pdo->lastInsertId();
// $statusBm = $stmtBm->execute();
// var_dump($nextId);


// if($statusTag==false){
if(!$statusTag){
    // $categoryに合致する値がない場合
    // gs_bmtag_tableに新しいtagとして登録し、
    sqlError($stmtTag);
    $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
    $stmtTagInsert = $pdo->prepare($sqlTagInsert);
    $stmtTagInsert->bindValue(':tag_name', $category, PDO::PARAM_STR);
    $statusTagInsert = $stmtTagInsert->execute();

    // gs_bmtag_bindに、$categoryの値とgs_bm_tableのauto_incrementの値を一緒に格納
    $tagId = $statusTag["id"]; //書き方あってる？
    $sqlBmTag = "INSERT INTO gs_bmtag_bind (bm_id, tagId) VALUE (:bm_id, :tagId)";
    $stmtBmTag = $pdo->prepare($sqlBmTag);
    $stmtBmTag->bindValue(':bm_id', $nextId, PDO::PARAM_STR);
    $stmtBmTag->bindValue(':tagId', $tagId, PDO::PARAM_STR);
    $statusBmTag = $stmtBmTag->execute();

}else{
    //$categoryに合致する値がある場合
    // gs_bmtag_bindに、gs_bmtag_tableのidとgs_bm_tableのauto_incrementの値を一緒に格納
    $tagId = $statusTag["id"]; //書き方あってる？
    $sqlBmTag = "INSERT INTO gs_bmtag_bind (bm_id, tagId) VALUE (:bm_id, :tagId)";
    $stmtBmTag = $pdo->prepare($sqlBmTag);
    $stmtBmTag->bindValue(':bm_id', $nextId, PDO::PARAM_STR);
    $stmtBmTag->bindValue(':tagId', $tagId, PDO::PARAM_STR);
    $statusBmTag = $stmtBmTag->execute();
}


//3. データ登録SQL作成
$sql = "INSERT INTO gs_bm_table (book,author,datetime,category,summary,comment) VALUES(:book,:author,sysdate(),:category,:summary,:comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':book', $book, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//4. データ登録処理後
if($status==false){
    sqlError($stmt);
}else{
    //5. index.phpにリダイレクト
    // header("Location: index.php");
    exit;
}

?>