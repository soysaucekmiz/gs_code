<head>
<meta charset="utf-8">
<title>File読み込み</title>
</head>
<body>
<h1>コメント一覧</h1>

<table border='1'>
<tr><th>名前</th><th>Mail</th><th>コメント</th></tr>

<?php

if( ($file = fopen("data/data.csv", "r")) === false){
    die("csv読み込みエラー");
}

while(($array = fgetcsv($file)) !== FALSE){

    echo "<tr>";
    for($i=0; $i<count($array); ++$i){
        $elem = $array[$i];
        echo("<td>".$elem."</td>");
    }
    echo "</tr>";

}

fclose($file);
?>


<ul>
<li><a href="index.php">トップへ</a></li>
</ul>
</body>
</html>