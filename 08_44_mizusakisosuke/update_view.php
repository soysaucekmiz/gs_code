<?php
include "funcs.php";

// GETデータ取得
$id = $_GET["id"];

// DB接続
$pdo = db_connect();

// データ更新SQL
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_STR);
$status = $stmt->execute();

// データ表示
if($status==false){
    sqlError($stmt);
}else{
    $row = $stmt->fetch();
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
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
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
                <label>カテゴリ：<textarea name="category" rows="1" cols="40"><?=$row["category"]?></textarea></label><br>
                <label><input type="hidden" name="category_origin" value="<?=$row["category"]?>"></label><br> <!-- 元のcategoryの値をPOSTするため -->
                <label>要約：<textarea name="summary" rows="4" cols="40"><?=$row["summary"]?></textarea></label><br>
                <label>感想：<textarea name="comment" rows="4" cols="40"><?=$row["comment"]?></textarea></label><br>
                <label><input type="hidden" name="id" value="<?=$row["id"]?>"></label>
                <input type="submit" values="更新">
            </fieldset>
        </div>
    </form>
    <a href="select.php"><input type="button" value="一覧に戻る"></a>
    </main>
    <!-- main[end] -->
    

</body>

</html>