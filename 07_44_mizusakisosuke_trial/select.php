<?php
//共通関数の呼び出し
include("funcs.php");


//1. DB接続
$pdo = db_connect();


//2. 検索条件の受取、SQL作成
if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];
    // $sql = "SELECT * FROM gs_bm_table WHERE book LIKE '%".$searchKw."%'"; //一旦書籍名からのみ
    $sql = "SELECT * FROM gs_bm_table WHERE book LIKE '%".$searchKw."%' OR author LIKE '%".$searchKw."%' OR category LIKE '%".$searchKw."%' OR summary LIKE '%".$searchKw."%' OR comment LIKE '%".$searchKw."%'"; 
}else{
    $sql = "SELECT * FROM gs_bm_table";
}
// $stmt = $pdo->prepare($sql);
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    // while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){ //fetchAllだと動かない
        $view .= "<tr>"."<td>".$result["id"]."</td>"."<td>".$result["book"]."</td>"."<td>".$result["author"]."</td>"."<td>".$result["datetime"]."</td>"."<td>".$result["category"]."</td>"."<td>".$result["summary"]."</td>"."<td>".$result["comment"]."</td>"."</tr>";
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
        </tr>
            <?=$view?>
        </table>

        </div>
    </main>

</body>

</html>