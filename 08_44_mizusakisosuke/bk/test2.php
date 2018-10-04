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

//3. データ登録SQL作成
$sql = "INSERT INTO gs_bm_table (book,author,datetime,category,summary,comment) VALUES(:book,:author,sysdate(),:category,:summary,:comment)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':book', $book, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':summary', $summary, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
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
// var_dump($statusTagSearch);
// var_dump($categoryLen);
// var_dump($tagSearch);
// var_dump($tag_id);

if($statusTagSearch == false){
    sqlError($stmtTagSearch);
    $view = "SQLエラー";

}else if($categoryLen==0){
    // カテゴリが未入力の場合
    exit("categoryはNULLです。");

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

}else{
    // gs_bmtag_tableに該当する値が存在する場合
    $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
    $stmtBindInsert = $pdo->prepare($sqlBindInsert);
    $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
    $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
    $statusBindInsert = $stmtBindInsert->execute();
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test2_insert.phpのテスト</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px; font-size: 16px;}</style>
</head>

<body>
    <div>
        if文判定：<?=$view?>
    </div>
</body>

</html>
