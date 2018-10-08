<?php
session_start();

//共通関数の呼び出し
include("funcs.php");
chkSsid();


//1. DB接続
$pdo = db_connect();

$sql = "";
$sql .= "SELECT "; 
$sql .= "gs_bm_table.id AS bm_id, ";
$sql .= "gs_bm_table.book AS book, ";
$sql .= "gs_bm_table.author AS author, ";
$sql .= "gs_bm_table.datetime AS datetime, ";
$sql .= "gs_bm_table.summary AS summary, ";
$sql .= "gs_bm_table.comment AS comment, ";
$sql .= "gs_bmtag_table.id AS tag_id, ";
$sql .= "gs_bmtag_table.tag_name AS tag_name ";
$sql .= "FROM ";
$sql .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
$sql .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";

if(isset($_GET["tag_id"])){
    $tag_id = $_GET["tag_id"];
    $sql .= "WHERE tag_id = ".$tag_id." ";
}

if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];
    $sql .= "WHERE book LIKE '%".$searchKw."%' OR author LIKE '%".$searchKw."%' OR category LIKE '%".$searchKw."%' OR summary LIKE '%".$searchKw."%' OR comment LIKE '%".$searchKw."%' ";
}

$sql .= "ORDER BY gs_bm_table.id";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $view .= "<tr>";
        $view .= "<td>".$result["bm_id"]."</td>";
        $view .= "<td>".$result["book"]."</td>";
        $view .= "<td>".$result["author"]."</td>";
        $view .= "<td>".$result["datetime"]."</td>";
        $view .= '<td><a href="select.php?tag_id='.$result["tag_id"].'">'.$result["tag_name"].'</a></td>'; // あとでaタグでtag_idに遷移させる
        $view .= "<td>".$result["summary"]."</td>";
        $view .= "<td>".$result["comment"]."</td>";
        $view .= '<td><a href="update_view.php?id='.$result["bm_id"].'">[更新]</a></td>';
        $view .= '<td><a href="delete.php?id='.$result["bm_id"].'">[削除]</a></td>';
        $view .= "</tr>";
    }
}

// tagの数を数えて降順でならべかえる
// $sqlTagCount = "SELECT tag_id, count(*) FROM gs_bmtag_bind GROUP BY tag_id ORDER BY count(*) DESC";
$sqlTagCount = "";
$sqlTagCount .= "SELECT ";
$sqlTagCount .= "gs_bm_table.id AS bm_id, ";
$sqlTagCount .= "gs_bmtag_bind.tag_id AS tag_id, ";
$sqlTagCount .= "gs_bmtag_table.tag_name AS tag_name, ";
$sqlTagCount .= "count(*) ";
$sqlTagCount .= "FROM ";
// $sqlTagCount .= "gs_bmtag_bind LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
$sqlTagCount .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
$sqlTagCount .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
$sqlTagCount .= "GROUP BY tag_id ";
$sqlTagCount .= "ORDER BY COUNT(*) DESC";

$stmtTagCount = $pdo->prepare($sqlTagCount);
$statusTagCount = $stmtTagCount->execute();

$tagView = "";
if($statusTagCount==false){
    sqlError($stmtTagCount);
}else{
    while($tagList = $stmtTagCount->fetch(PDO::FETCH_ASSOC)){
        $tagView .= '<a href="select.php?tag_id='.$tagList["tag_id"].'">'.$tagList["tag_name"].'</a> ';
    }
}


?>

<!DOCTYPE html>
<html> <!-- lang="ja" は一旦書かない  -->

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>読書メモ一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px; font-size: 16px;}</style>
</head>

<body> <!-- id="main"は一旦除外 -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a href="index.php" class="navbar-brand">読書メモ登録</a>
                <a href="mypage.php" class="navbar-brand"><?=$_SESSION["name"]?></a>
                <a class="navbar-brand" href="logout.php">ログアウト</a>
                <?php if($_SESSION["kanri_flg"]=="1"){ ?><a class="navbar-brand" href="user_select.php">管理者メニュー</a><?php } ?>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <!-- 検索 -->
        <form action="" method="get">
        <div class="filter">
            <label>検索語句：<input type="text" name="searchKw"></label><br>
            <input type="submit" value="検索">
        </div>
        </form>
        <div class="tagView">
            <?=$tagView?>
        </div>

        <!-- 全ての一覧 -->
        <a href="select.php">すべての一覧</a>

        <!-- 一覧 -->
        <div class="container jumbotron">
        <table border="solid" margin="5px">
        <tr>
            <th>ID</th>
            <th>書籍名</th>
            <th>著者名</th>
            <th>登録日</th>
            <th>カテゴリ</th>
            <th>要約</th>
            <th>感想</th>
            <th>更新</th>
            <th>削除</th>
        </tr>
            <?=$view?>
        </table>

        </div>
    </main>

</body>

</html>