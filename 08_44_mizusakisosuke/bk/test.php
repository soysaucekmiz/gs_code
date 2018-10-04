<?php

$keyword = $_GET['search'];

// キーワードの空白を半角へ変換
$keywords = str_replace("　", " ", $keyword);
// このへんでサニタイズすればいいんだけど面倒くさくてやめた
// 空白毎に配列に収納
$search_arr = preg_split("/[ ]+/",$keywords);

$sql = "select * from cb2ExprtFailure";
$concat = "concat_ws(' ','id','category','group','system','version','menu','processing','event',
    'failure','coping','workaround','breeder','provision','specialNote','accrual','fixVersion',
    'createDate','postPosition','postUser','priority','categoryFailure','developer','fixScheduledDate',
    'completScheduledDate','finishDev','level','import')";

$where = " WHERE 1";

foreach($search_arr as $item){
    if($item != ""){
        $where .= " AND ".$concat." LIKE '%{$item}%'";
    }
}
$std = $dbh->prepare($sql.$where);
$std->execute();
$hoge = $std->fetchAll();

var_dump($hoge);





/* 検索機能をつける前のSQL+表示 */
//2. データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= "<tr>"."<td>".$result["id"]."</td>"."<td>".$result["book"]."</td>"."<td>".$result["author"]."</td>"."<td>".$result["datetime"]."</td>"."<td>".$result["category"]."</td>"."<td>".$result["summary"]."</td>"."<td>".$result["comment"]."</td>"."</tr>";
    }
}





/* 複数フィールドでの検索機能（失敗） */
//2. 検索条件の受取、SQL作成
if(isset($_GET["searchKw"])){
    $searchKw = $_GET["searchKw"];

    // キーワードの空白を半角に変換
    $searchKw = str_replace("　", " ", $searchKw);
    // 空白ごとに配列に格納
    $searchArr = preg_split("/[ ]+/", $searchKw);

    // //SQLの作成
    $sql = "select * from gs_bm_table";
    $concat = "CONCAT_WS(' ', 'book', 'author', 'category', 'summary', 'comment')";
    $where = " WHERE 1";

    foreach($searchArr as $item){
        if($item != ""){
            $where .= " AND ".$concat." LIKE '%".$item."%'";
        }
    }
    // $sql = "SELECT * FROM gs_bm_table WHERE book LIKE '%".$searchKw."%'"; //一旦書籍名からのみ
}else{
    $sql = "SELECT * FROM gs_bm_table";
    $where = "";
}
// $stmt = $pdo->prepare($sql);
$stmt = $pdo->prepare($sql.$where);
$status = $stmt->execute();


//3. データ表示
$view = "";
if($status==false){
    sqlError($stmt);
}else{
    // while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    while($result = $stmt->fetchAll(PDO::FETCH_ASSOC)){ //fetchAllだと動かない
        $view .= "<tr>"."<td>".$result["id"]."</td>"."<td>".$result["book"]."</td>"."<td>".$result["author"]."</td>"."<td>".$result["datetime"]."</td>"."<td>".$result["category"]."</td>"."<td>".$result["summary"]."</td>"."<td>".$result["comment"]."</td>"."</tr>";
    }
}




?>