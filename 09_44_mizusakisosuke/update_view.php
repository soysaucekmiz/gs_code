<?php
session_start();

include "funcs.php";
chkSsid();

// GETデータ取得
$bm_id = $_GET["id"];

// DB接続
$pdo = db_connect();

// ver.3 タグの存在チェック
$sqlBindSearch = "SELECT * FROM gs_bmtag_bind WHERE bm_id = :bm_id";
$stmtBindSearch = $pdo->prepare($sqlBindSearch);
$stmtBindSearch->bindValue(":bm_id", $bm_id, PDO::PARAM_INT);
$statusBindSearch = $stmtBindSearch->execute();
$bindSearch = $stmtBindSearch->fetch(PDO::FETCH_ASSOC); // 1つでもあれば良いのでwhileは省略

if($bindSearch === false){
    $sql = "SELECT * FROM gs_bm_table WHERE id = :bm_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":bm_id", $bm_id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // データ表示
    if($status==false){
        sqlError($stmt);
    }else{
        $row = $stmt->fetch();
        $tags = "";
    }

}else{
    $sql = "SELECT ";
    $sql .= "gs_bm_table.id AS bm_id, ";
    $sql .= "gs_bm_table.book AS book, ";
    $sql .= "gs_bm_table.author AS author, ";
    $sql .= "gs_bm_table.summary AS summary, ";
    $sql .= "gs_bm_table.comment AS comment, ";
    $sql .= "GROUP_CONCAT(gs_bmtag_table.tag_name SEPARATOR ', ') AS tag_names ";
    $sql .= "FROM ";
    $sql .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
    $sql .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
    $sql .= "WHERE bm_id=:bm_id ";
    $sql .= "GROUP BY bm_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":bm_id", $bm_id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // データ表示
    if($status==false){
        sqlError($stmt);
    }else{
        $row = $stmt->fetch();
        $tags = $row["tag_names"];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta>
    <title>データ登録</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px;font-size:16px;}</style>
</head>

<body>
    <!-- head[start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="select.php">データ一覧</a>
                    <a href="mypage.php" class="navbar-brand"><?=$_SESSION["name"]?></a>
                    <a class="navbar-brand" href="logout.php">ログアウト</a>
                    <?php if($_SESSION["kanri_flg"]=="1"){ ?><a class="navbar-brand" href="user_select.php">管理者メニュー</a><?php } ?>
                </div>
            </div>
        </nav>
    </header>
    <!-- head[end] -->
    
    <!-- main[start] -->
    <main>
    <form action="update.php" method="post">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックリスト</legend>
                <label>書籍名：<input type="text" name="book" value="<?=$row["book"]?>"></label><br>
                <label>著者名：<input type="text" name="author" value="<?=$row["author"]?>"></label><br>
                <label>カテゴリ：<textarea name="category" rows="1" cols="40"><?=$tags?></textarea></label><br>
                <label><input type="hidden" name="category_origin" value="<?=$row["category"]?>"></label><br> <!-- 元のcategoryの値をPOSTするため -->
                <label>要約：<textarea name="summary" rows="4" cols="40"><?=$row["summary"]?></textarea></label><br>
                <label>感想：<textarea name="comment" rows="4" cols="40"><?=$row["comment"]?></textarea></label><br>
                <label><input type="hidden" name="id" value="<?=$row["bm_id"]?>"></label>
                <input type="submit" values="更新">
            </fieldset>
        </div>
    </form>
    <a href="select.php"><input type="button" value="一覧に戻る"></a>
    </main>
    <!-- main[end] -->
    

</body>

</html>