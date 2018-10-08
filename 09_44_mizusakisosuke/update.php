<?php
include "funcs.php";

// POSTデータ取得
$book = $_POST["book"];
$author = $_POST["author"];
$category = $_POST["category"];
$summary = $_POST["summary"];
$comment = $_POST["comment"];
$id = $_POST["id"];

$category_origin = $_POST["category_origin"];

// DB接続
$pdo = db_connect();

// SQL gs_bm_table UPDATE処理
$sqlBmUpdate = "UPDATE gs_bm_table SET book=:book, author=:author, category=:category, summary=:summary, comment=:comment WHERE id=:id";
$stmtBmUpdate = $pdo->prepare($sqlBmUpdate);
$stmtBmUpdate->bindValue(":book", $book, PDO::PARAM_STR);
$stmtBmUpdate->bindValue(":author", $author, PDO::PARAM_STR);
$stmtBmUpdate->bindValue(":category", $category, PDO::PARAM_STR);
$stmtBmUpdate->bindValue(":summary", $summary, PDO::PARAM_STR);
$stmtBmUpdate->bindValue(":comment", $comment, PDO::PARAM_STR);
$stmtBmUpdate->bindValue(":id", $id, PDO::PARAM_INT);
$statusBmUpdate = $stmtBmUpdate->execute();

// 一旦コメントアウト
// header("Location: select.php");


// $categoryが空でないかを確認するために長さを取得
$categoryLen = strlen($category);
$categoryOriginLen = strlen($category_origin);


// $categoryのidを取得（一旦外で書く？）
$sqlTagSearch = "SELECT * FROM gs_bmtag_table WHERE tag_name = '".$category."'";
$stmtTagSearch = $pdo->prepare($sqlTagSearch);
$statusTagSearch = $stmtTagSearch->execute();
$tagSearch = $stmtTagSearch->fetch(PDO::FETCH_ASSOC);
$tag_id = $tagSearch["id"];

// gs_bmtag_bindのidを取得（一旦外で書く？）
$sqlBindSearch = "SELECT * FROM gs_bmtag_bind WHERE bm_id =".$id;
$stmtBindSearch = $pdo->prepare($sqlBindSearch);
$statusBindSearch = $stmtBindSearch->execute();
$bindSearch = $stmtBindSearch->fetch(PDO::FETCH_ASSOC);
$bind_id = $bindSearch["id"];

// 実際の処理 ver.2
// $categoryが更新されてない場合
if($category == $category_origin){
    // 処理なしで終了
    echo "tag変更なし";
    header("Location: select.php");

// $categoryが更新された場合
}else{
    // sqlエラーの場合
    if($statusTagSearch==false){
        sqlError($stmtTagSearch);

    // 新しい$categoryがNULLの場合
    }else if($categoryLen==0){
        // gs_bmtag_tableは対応なし
        // gs_bmtag_bindからid=$idのレコードを削除
        $sqlBindDelete = "DELETE FROM gs_bmtag_bind WHERE id=:id";
        $stmtBindDelete = $pdo->prepare($sqlBindDelete);
        $stmtBindDelete->bindValue(":id", $bind_id, PDO::PARAM_INT);
        $statusBindDelete = $stmtBindDelete->execute();
        header("Location: select.php");

    // $categoryが既存のタグと一致しない場合
    }else if($tagSearch===false){
        // gs_bmtag_table: 次のidを取得し、タグ登録
        $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
        $stmtTagInsert = $pdo->prepare($sqlTagInsert);
        $stmtTagInsert->bindValue(":tag_name", $category, PDO::PARAM_STR);
        $statusTagInsert = $stmtTagInsert->execute();
        $tag_id = $pdo->lastInsertId();

        // $category_originがNULLの場合（$categoryOriginLen=0）
        if($bindSearch===false){
            $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE(:bm_id, :tag_id)";
            $stmtBindInsert = $pdo->prepare($sqlBindInsert);
            $stmtBindInsert->bindValue(":bm_id", $id, PDO::PARAM_INT);
            $stmtBindInsert->bindValue(":tag_id", $tag_id, PDO::PARAM_INT);
            $statusBindInsert = $stmtBindInsert->execute();
            header("Location: select.php");

        // $category_originがNULLでない場合（$categoryOriginLen>0）
        }else{
            // gs_bmtag_bind: bm_id=$id, tag_id=次のAI値 で更新
            $sqlBindUpdate = "UPDATE gs_bmtag_bind SET bm_id=:bm_id, tag_id=:tag_id WHERE id=:id";
            $stmtBindUpdate = $pdo->prepare($sqlBindUpdate);
            $stmtBindUpdate->bindValue(":bm_id", $id, PDO::PARAM_INT);
            $stmtBindUpdate->bindValue(":tag_id", $tag_id, PDO::PARAM_INT);
            $stmtBindUpdate->bindValue(":id", $bind_id, PDO::PARAM_INT);
            $statusBindUpdate = $stmtBindUpdate->execute();
            header("Location: select.php");

        }

    // $categoryが既存のタグと一致する場合
    }else{
        // gs_bmtag_tableのid=$tag_idを取得し、tagテーブルは更新はせず、bindテーブルのみ更新

        //$category_originがNULLの場合
        if($bindSearch===false){
            $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE(:bm_id, :tag_id)";
            $stmtBindInsert = $pdo->prepare($sqlBindInsert);
            $stmtBindInsert->bindValue(":bm_id", $id, PDO::PARAM_INT);
            $stmtBindInsert->bindValue(":tag_id", $tag_id, PDO::PARAM_INT);
            $statusBindInsert = $stmtBindInsert->execute();
            header("Location: select.php");

        // $category_originがNULLでない場合
        }else{
            // gs_bmtag_bindをUPDATE bm_id=$id, tag_id=$tag_id
            $sqlBindUpdate = "UPDATE gs_bmtag_bind SET bm_id=:bm_id, tag_id=:tag_id WHERE id=:id";
            $stmtBindUpdate = $pdo->prepare($sqlBindUpdate);
            $stmtBindUpdate->bindValue(":bm_id", $id, PDO::PARAM_INT);
            $stmtBindUpdate->bindValue(":tag_id", $tag_id, PDO::PARAM_INT);
            $stmtBindUpdate->bindValue(":id", $bind_id, PDO::PARAM_INT);
            $statusBindUpdate = $stmtBindUpdate->execute();
            header("Location: select.php");

        }
    }
}


?>