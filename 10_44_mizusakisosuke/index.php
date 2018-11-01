<?php
session_start();

include "funcs.php";
chkSsid();

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
                    <a class="navbar-brand" href="select.php">読書メモ一覧</a>
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
    <form action="insert.php" method="post">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックリスト</legend>
                <label>書籍名：<input type="text" name="book"></label><br>
                <label>著者名：<input type="text" name="author"></label><br>
                <label>カテゴリ：<textarea name="category" rows="1" cols="40"></textarea></label><br>
                <label>要約：<textarea name="summary" rows="4" cols="40"></textarea></label><br>
                <label>感想：<textarea name="comment" rows="4" cols="40"></textarea></label><br>
                <input type="submit" values="送信">
            </fieldset>
        </div>
    </form>
    </main>
    <!-- main[end] -->
    

</body>

</html>