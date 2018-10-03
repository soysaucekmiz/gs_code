<?php
include "funcs.php";

// 1. GETデータ取得
$id = $_GET["id"];

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
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>lid？？？：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード？：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <label>管理者フラグ：<br>
        <input type="radio" name="kanri_flg", value="0" <?php if($row["kanri_flg"]==0){echo "checked";}?>>管理者
        <input type="radio" name="kanri_flg", value="1" <?php if($row["kanri_flg"]==1){echo "checked";}?>>スーパー管理者
     </label><br>
     <label>利用フラグ：<br>
        <input type="radio" name="life_flg", value="0" <?php if($row["life_flg"]==0){echo "checked";}?>>使用中
        <input type="radio" name="life_flg", value="1" <?php if($row["life_flg"]==1){echo "checked";}?>>使用しなくなった
     </label><br>
     <label><input type="hidden" name="id" value="<?=$row["id"]?>"></label>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<a href="user_select.php"><input type="button" value="戻る"></a>

<!-- Main[End] -->


</body>
</html>
