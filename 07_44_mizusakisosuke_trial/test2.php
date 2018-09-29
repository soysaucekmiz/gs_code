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
$bm_id = $pdo->lastInsertId(); // gs_bm_tableに新規登録するデータのid値の取得に成功
// $view = $bm_id; // test ok



// // gs_bmtag_tableに該当する値が存在しない場合
// // gs_bmtag_table -> $categoryをtag_nameに格納
// $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
// $stmtTagInsert = $pdo->prepare($sqlTagInsert);
// $stmtTagInsert->bindValue(':tag_name', $category, PDO::PARAM_STR);
// $statusTagInsert = $stmtTagInsert->execute();
// $tag_id = $pdo->lastInsertId();

// // gs_bmtag_bind -> 新規のgs_bm_tableのレコードと既存のタグidをマッピング登録
// $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
// $stmtBindInsert = $pdo->prepare($sqlBindInsert);
// $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT); // gs_bm_table lastInsertId
// $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT); // gs_bmtag_table lastInsertId
// $statusBindInsert = $stmtBindInsert->execute();



// gs_bmtag_table.tag_nameに、$categoryと同値があるかを確認 ※ ※ ※
$sqlTagSearch = "SELECT * FROM gs_bmtag_table WHERE tag_name = '".$category."'";
$stmtTagSearch = $pdo->prepare($sqlTagSearch);
$statusTagSearch = $stmtTagSearch->execute();
$tagSearch = $stmtTagSearch->fetch(PDO::FETCH_ASSOC);

$view = "";
$categoryLen = strlen($category);

/*
 * test
 * var_dump($category);
 * var_dump($statusTagSearch);
 * $tagSearch = $stmtTagSearch->fetch(PDO::FETCH_ASSOC);
 * var_dump($categorySearch);
 * 
 * パターン1: strlen($category) = 0 -> bindなし、tag登録なし
 * パターン2: $tagSearch = false
 * パターン3: $tagSearch != false
 */

if($statusTagSearch == false){
    sqlError($stmtTagSearch);
    $view = "SQLエラー";

}else if($categoryLen=0){
    $view = "カテゴリがNULL";
    exit("$categoryはNULLです。");

}else if($tagSearch = false){
    // gs_bmtag_tableに該当する値が存在しない場合

    // gs_bmtag_table -> $categoryをtag_nameに格納
    $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
    $stmtTagInsert = $pdo->prepare($sqlTagInsert);
    $stmtTagInsert->bindValue(':tag_name', $category, PDO::PARAM_STR);
    $statusTagInsert = $stmtTagInsert->execute();
    $tag_id = $pdo->lastInsertId();

    // gs_bmtag_bind -> 新規のgs_bm_tableのレコードと既存のタグidをマッピング登録
    $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
    $stmtBindInsert = $pdo->prepare($sqlBindInsert);
    $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT); // gs_bm_table lastInsertId
    $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT); // gs_bmtag_table lastInsertId
    $statusBindInsert = $stmtBindInsert->execute();

    $view = "既存タグに合致する値がない";

}else{
    // gs_bmtag_tableに該当する値が存在する場合

    // gs_bmtag_table -> すでに存在するため必要なし
    // gs_bmtag_bind -> 新規のgs_bm_tableのレコードと既存のタグidをマッピング登録
    while($result = $stmtTagSearch->fetch(PDO::FETCH_ASSOC)){
        // $view .= "id: ".$result["id"].", "."tag_name: ".$result["tag_name"]."<br>"; // $result[]でgs_bmtag_tableで照合した値を取り出すtest ok
        $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
        $stmtBindInsert = $pdo->prepare($sqlBindInsert);
        $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
        $stmtBindInsert->bindValue(':tag_id', $result["id"], PDO::PARAM_INT);
        $statusBindInsert = $stmtBindInsert->execute();

        // bm_id, tag_id, tag_nameを確認
        $view = "既存タグパターン, bm_id: ".$bm_id.", tag_id: ".$result["id"].", tag_name: ".$category;

    }
}

/* 以下、リライト */

// if($statusTagSearch == false){
// //     sqlError($stmtTagSearch);
// // gs_bmtag_tableに該当する値が存在しない場合
// // gs_bmtag_table -> $categoryをtag_nameに格納
// $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
// $stmtTagInsert = $pdo->prepare($sqlTagInsert);
// $stmtTagInsert->bindValue(':tag_name', $category, PDO::PARAM_STR);
// $statusTagInsert = $stmtTagInsert->execute();
// $tag_id = $pdo->lastInsertId();

// // gs_bmtag_bind -> 新規のgs_bm_tableのレコードと既存のタグidをマッピング登録
// $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
// $stmtBindInsert = $pdo->prepare($sqlBindInsert);
// $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT); // gs_bm_table lastInsertId
// $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT); // gs_bmtag_table lastInsertId
// $statusBindInsert = $stmtBindInsert->execute();

// // bm_id, tag_id, tag_nameを確認
// $view = "新規タグパターン, bm_id: ".$bm_id.", tag_id: ".$tag_id.", tag_name: ".$category;

// }else{
//     // gs_bmtag_tableに該当する値が存在する場合
//     // gs_bmtag_table -> すでに存在するため必要なし
//     // gs_bmtag_bind -> 新規のgs_bm_tableのレコードと既存のタグidをマッピング登録
//     while($result = $stmtTagSearch->fetch(PDO::FETCH_ASSOC)){
//         // $view .= "id: ".$result["id"].", "."tag_name: ".$result["tag_name"]."<br>"; // $result[]でgs_bmtag_tableで照合した値を取り出すtest ok
//         $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
//         $stmtBindInsert = $pdo->prepare($sqlBindInsert);
//         $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
//         $stmtBindInsert->bindValue(':tag_id', $result["id"], PDO::PARAM_INT);
//         $statusBindInsert = $stmtBindInsert->execute();

//         // bm_id, tag_id, tag_nameを確認
//         $view = "既存タグパターン, bm_id: ".$bm_id.", tag_id: ".$result["id"].", tag_name: ".$category;

//     }
// }



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test2_insert.phpのテスト</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px; font-size: 16px;}</style>
</head>

<body>
    <div>
        タグ情報：<?=$view?>
    </div>
</body>

</html>
