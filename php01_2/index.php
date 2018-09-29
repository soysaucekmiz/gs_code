<html>
<head>
<meta charset="utf-8">
<title>POST練習</title>
</head>
<body>
<h1>コメントフォーム</h1>
<form action="write.php" method="post">
	お名前: <input type="text" name="name"><br>
	EMAIL: <input type="text" name="mail"><br>
	コメント: <input type="text" name="cmt">
	<input type="submit" value="送信">
</form>
<ul>
<li><a href="read.php">回答一覧</a></li>
</ul>
</body>
</html>