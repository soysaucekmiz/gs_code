<?php
session_start();

//共通関数の呼び出し
include("funcs.php");
chkSsid();
$user_id = $_SESSION["id"];

// ページネーション (1)
if(isset($_GET["page"])){
    $page = $_GET["page"];
}else{
    $page = 1;
}
if($page > 1){
    $start = ($page * 10) - 10;
}else{
    $start = 0;
}


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
$sql .= "gs_bm_table.user_id AS user_id, ";
$sql .= "GROUP_CONCAT(gs_bmtag_table.id SEPARATOR ',') AS tag_ids, ";
$sql .= "GROUP_CONCAT(gs_bmtag_table.tag_name SEPARATOR ',') AS tag_names ";
$sql .= "FROM ";
$sql .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
$sql .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";

$sql .= "WHERE user_id = ".$user_id." ";

if(isset($_GET["tag_id"])){
    $tag_id = $_GET["tag_id"];
    $sql .= "AND tag_id = ".$tag_id." ";
}

if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];
    $sql .= "AND ( book LIKE '%".$searchKw."%' OR author LIKE '%".$searchKw."%' OR category LIKE '%".$searchKw."%' OR summary LIKE '%".$searchKw."%' OR comment LIKE '%".$searchKw."%' ) ";    
}

$sql .= "GROUP BY bm_id ";

$sql .= "ORDER BY gs_bm_table.id ";
$sql .= "LIMIT $start, 10";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
        $tag_id = explode(',', $result["tag_ids"]);
        $tag_name = explode(',', $result["tag_names"]);

        $view .= "<tr>";
        $view .= "<td>".$result["bm_id"]."</td>";
        $view .= "<td>".$result["book"]."</td>";
        $view .= "<td>".$result["author"]."</td>";
        $view .= "<td>".$result["datetime"]."</td>";

        $view .= '<td>';
        for($i=0; $i<count($tag_id); $i++){
            $view .= '<a href="select.php?tag_id='.$tag_id[$i].'">'.$tag_name[$i].' </a>';
        }
        $view .= '</td>';

        $view .= "<td>".$result["summary"]."</td>";
        $view .= "<td>".$result["comment"]."</td>";
        $view .= "<td>".$result["user_id"]."</td>";
        $view .= '<td><a href="update_view.php?id='.$result["bm_id"].'">[更新]</a></td>';
        $view .= '<td><a href="delete.php?id='.$result["bm_id"].'">[削除]</a></td>';
        $view .= "</tr>";
    }
}


// ページネーション (2)
$sqlPageCount = "SELECT ";
$sqlPageCount .= "gs_bm_table.id AS bm_id, ";
$sqlPageCount .= "GROUP_CONCAT(gs_bmtag_table.id SEPARATOR ',') AS tag_ids, ";
$sqlPageCount .= "COUNT(distinct bm_id) AS count FROM ";
$sqlPageCount .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
$sqlPageCount .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
$sqlPageCount .= "WHERE user_id = ".$user_id." ";
if(isset($_GET["tag_id"])){
    $tag_id = $_GET["tag_id"];
    $sqlPageCount .= "AND tag_id = ".$tag_id." ";
}
if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];
    $sqlPageCount .= "AND (book LIKE '%".$searchKw."%' OR author LIKE '%".$searchKw."%' OR category LIKE '%".$searchKw."%' OR summary LIKE '%".$searchKw."%' OR comment LIKE '%".$searchKw."%') ";    
}
$sql .= "GROUP BY bm_id";

$stmtPageCount = $pdo->prepare($sqlPageCount);
$statusPageCount = $stmtPageCount->execute();
$pageCount = $stmtPageCount->fetch(PDO::FETCH_ASSOC);
$pageCount = $pageCount["count"];
$pagenation = ceil($pageCount / 10);

$viewPagenation = "";
for($i=1; $i<=$pagenation; $i++){
    $viewPagenation .= '<a href="?page='.$i.'">'.$i.' </a>';
}

// PagePref & pageNext
$page = intval($page);
if($page==1){
    $viewPagePrev = "";
    if($page==$pagenation){
        $viewPageNext = "";
    }else{
        $pageNext = $page + 1;
        $viewPageNext = '<a href="?page='.$pageNext.'">次</a>';
    }
}else{
    $pagePrev = $page - 1;
    $viewPagePrev = '<a href="?page='.$pagePrev.'">前</a>';
    if($page==$pagenation){
        $viewPageNext = "";
    }else{
        $pageNext = $page + 1;
        $viewPageNext = '<a href="?page='.$pageNext.'">次</a>';
    }
}


// tagの数を数えて降順でならべかえる
$sqlTagCount = "";
$sqlTagCount .= "SELECT ";
$sqlTagCount .= "gs_bm_table.id AS bm_id, ";
$sqlTagCount .= "gs_bmtag_bind.tag_id AS tag_id, ";
$sqlTagCount .= "gs_bmtag_table.tag_name AS tag_name, ";
$sqlTagCount .= "count(*) ";
$sqlTagCount .= "FROM ";
$sqlTagCount .= "gs_bm_table LEFT OUTER JOIN gs_bmtag_bind ON gs_bm_table.id = gs_bmtag_bind.bm_id ";
$sqlTagCount .= "LEFT OUTER JOIN gs_bmtag_table ON gs_bmtag_bind.tag_id = gs_bmtag_table.id ";
$sqlTagCount .= "WHERE user_id = ".$user_id." ";
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

// ユーザー画像表示
$sqlImage = "SELECT image FROM gs_user_table WHERE id = ".$user_id;
$stmtImage = $pdo->prepare($sqlImage);
$statusImage = $stmtImage->execute();

$viewImage="";
if($statusImage==false){
    sqlError($stmtImage);
}else{
    $userImage = $stmtImage->fetch(PDO::FETCH_ASSOC);
    // var_dump($userImage);
    $viewImage .= "<img src=".$userImage["image"]." width='50' height='50'>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>読書メモ一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px; font-size: 16px;}</style>
</head>

<body>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a href="index.php" class="navbar-brand">読書メモ登録</a>
                <a href="mypage.php" class="navbar-brand"><?=$viewImage?></a>
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

        <div>
        <!-- 全ての一覧 -->
            <a href="select.php">すべての一覧 </a>

        <!-- ページネーション -->
            <?=$viewPagePrev?>
            <?=$viewPagenation?>
            <?=$viewPageNext?>
        </div>

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
                    <th>ユーザーID</th>
                    <th>更新</th>
                    <th>削除</th>
                </tr>
                <?=$view?>
            </table>
        </div>
        
    </main>

</body>

</html>