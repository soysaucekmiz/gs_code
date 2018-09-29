<head>
<meta charset="utf-8">
<title>File書き込み</title>
</head>
<body>
<h1>コメント投稿完了</h1>

<?php
include("func.php");

$name = $_POST["name"];
$mail = $_POST["mail"];
$cmt = $_POST["cmt"];
$br = ",";
$str = $name.$br.$mail.$br.$cmt;

//File書き込み
$file = fopen("data/data.csv","a");	// ファイル読み込み
fwrite($file, $str."\n"); //"\n"は改行コード
fclose($file);
?>

こちらのコメントを保存しました。<br>
<br>
お名前：<?=h($name)?><br>
EMAIL：<?=h($mail)?><br>
コメント：<?=h($cmt)?>

<ul>
<li><a href="index.php">トップへ</a></li>
<li><a href="read.php">回答一覧</a></li>
</ul>
</body>
</html>