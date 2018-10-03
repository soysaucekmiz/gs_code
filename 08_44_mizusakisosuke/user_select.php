<?php
//共通関数の呼び出し
include("funcs.php");


//1. DB接続
$pdo = db_connect();


//2. 検索条件の受取、SQL作成
if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];
    $sql = "SELECT * FROM gs_user_table WHERE name LIKE '%".$searchKw."%'";
}else{
    $sql = "SELECT * FROM gs_user_table";
}
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= "<tr>";
        $view .= "<td>".$result["id"]."</td>";
        $view .= "<td>".$result["name"]."</td>";
        $view .= "<td>".$result["lid"]."</td>";
        $view .= "<td>".$result["lpw"]."</td>";
        $view .= "<td>".$result["kanri_flg"]."</td>";
        $view .= "<td>".$result["life_flg"]."</td>";
        $view .= '<td><a href="user_update_view.php?id='.$result["id"].'">[更新]</a></td>';
        $view .= '<td><a href="user_delete.php?id='.$result["id"].'">[削除]</a></td>';
        $view .= "</tr>";
    }
}


?>

<!DOCTYPE html>
<html> <!-- lang="ja" は一旦書かない  -->

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>div{padding: 10px; font-size: 16px;}</style>
</head>

<body> <!-- id="main"は一旦除外 -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a href="user_insert_view.php" class="navbar-brand">ユーザー登録</a>
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
            <th>名前</th>
            <th>lid？？？</th>
            <th>パスワード？</th>
            <th>管理者フラグ</th>
            <th>利用フラグ</th>
            <th>更新</th>
            <th>削除</th>
        </tr>
            <?=$view?>
        </table>

        </div>
    </main>

</body>

</html>