<?php
session_start();

include "funcs.php";
chkSsid();

// 1. GETデータ取得
$id = $_SESSION["id"];

//2. DB接続します
$pdo = db_connect();

//３．データ登録SQL作成
$sql = "SELECT * FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ表示
if ($status == false) {
    sqlError($stmt);
} else {
    $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>マイページ</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="select.php">読書メモ一覧</a>
      <a href="mypage.php" class="navbar-brand"><?=$_SESSION["name"]?></a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      <?php if($_SESSION["kanri_flg"]=="1"){ ?><a class="navbar-brand" href="user_select.php">管理者メニュー</a><?php } ?>
    </div>

    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="mypage_update.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報更新</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ログインID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード：<input type="password" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <input type="file" name="upfile"><br>
     <label><input type="hidden" name="id" value="<?=$row["id"]?>"></label> <!-- 要る？ -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<a href="select.php"><input type="button" value="戻る"></a>

<!-- Main[End] -->


</body>
</html>
