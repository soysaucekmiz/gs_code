<?php
include "funcs.php";

// POSTデータ取得
$book = $_POST["book"];
$author = $_POST["author"];
$category = $_POST["category"];
$summary = $_POST["summary"];
$comment = $_POST["comment"];
$bm_id = $_POST["id"];

// ユーザーが入力した文字列を分割
$tags = preg_split("/[\s,]+/", $category);
$tags = array_unique($tags);

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
$stmtBmUpdate->bindValue(":id", $bm_id, PDO::PARAM_INT);
$statusBmUpdate = $stmtBmUpdate->execute();


// もともと登録されていたタグを取得
$sqlBindSearch = "";
$sqlBindSearch .= "SELECT ";
$sqlBindSearch .= "gs_bmtag_bind.id AS bind_id, ";
$sqlBindSearch .= "gs_bmtag_bind.bm_id AS bm_id, ";
$sqlBindSearch .= "gs_bmtag_bind.tag_id AS tag_id, ";
$sqlBindSearch .= "gs_bmtag_table.tag_name AS tag_name ";
$sqlBindSearch .= "FROM ";
$sqlBindSearch .= "gs_bmtag_bind LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
$sqlBindSearch .= "WHERE bm_id = ".$bm_id;
$stmtBindSearch = $pdo->prepare($sqlBindSearch);
$statusBindSearch = $stmtBindSearch->execute();
if($statusBindSearch==false){
    sqlError($stmtBindSearch);
}else{
    $tags_origin = array();
    while($resultBindSearch = $stmtBindSearch->fetch(PDO::FETCH_ASSOC)){
        $tags_origin += array($resultBindSearch["bind_id"]=>$resultBindSearch["tag_name"]);
    }
}


// $tagが$tags_originに存在するか確認した上で登録処理
foreach($tags as $tag){

    // このbm_idに登録済みのタグだった場合
    if(in_array($tag, $tags_origin)){
        // 処理なし

    // このbm_idに未登録のタグだった場合
    }else{

        // gs_bmtag_tableにて他のタグで一致するものがあるか確認するための準備
        $sqlTagSearch = "SELECT * FROM gs_bmtag_table WHERE tag_name = '".$tag."'";
        $stmtTagSearch = $pdo->prepare($sqlTagSearch);
        $statusTagSearch = $stmtTagSearch->execute();
        $tagSearch = $stmtTagSearch->fetch(PDO::FETCH_ASSOC);
        $tag_id = $tagSearch["id"];

        if($statusTagSearch == false){
            sqlError($stmtTagSearch);

        // gs_bmtag_tableにて他のタグで一致するものがない場合
        }else if($tagSearch === false){

            // tag_tableに対しては、$tagの内容でinsert
            $sqlTagInsert = "INSERT INTO gs_bmtag_table (tag_name) VALUE (:tag_name)";
            $stmtTagInsert = $pdo->prepare($sqlTagInsert);
            $stmtTagInsert->bindValue(":tag_name", $tag, PDO::PARAM_STR);
            $statusTagInsert = $stmtTagInsert->execute();
            $tag_id = $pdo->lastInsertId();

            // tag_bindに対しては、tag_idとbm_idをinsertする
            $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
            $stmtBindInsert = $pdo->prepare($sqlBindInsert);
            $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
            $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
            $statusBindInsert = $stmtBindInsert->execute();

        // gs_bmtag_tableにて他のタグで一致するものがある場合
        }else{
            // tag_tableに対しては、処理なし

            // tag_bindに対しては、tag_idとbm_idをinsertする
            $sqlBindInsert = "INSERT INTO gs_bmtag_bind (bm_id, tag_id) VALUE (:bm_id, :tag_id)";
            $stmtBindInsert = $pdo->prepare($sqlBindInsert);
            $stmtBindInsert->bindValue(':bm_id', $bm_id, PDO::PARAM_INT);
            $stmtBindInsert->bindValue(':tag_id', $tag_id, PDO::PARAM_INT);
            $statusBindInsert = $stmtBindInsert->execute();

        }
    }
}


// $tag_originが$tagsに存在するか確認
foreach($tags_origin as $bind_id_origin => $tag_name_origin){

    // もともとこのbm_idに登録済みのタグが、新規登録するタグにも存在する場合
    if(in_array($tag_name_origin, $tags)){

        // 処理なし

    // もともとこのbm_idに登録済みのタグが、新規登録するタグには存在しない場合
    }else{

        // tag_tableに対しては、処理なし
        
        // tag_bindから、削除
        $sqlBindDelete = "DELETE FROM gs_bmtag_bind WHERE id=:id";
        $stmtBindDelete = $pdo->prepare($sqlBindDelete);
        $stmtBindDelete->bindValue(":id", $bind_id_origin, PDO::PARAM_INT);
        $statusBindDelete = $stmtBindDelete->execute();

    }
}

header("Location: select.php");


?>