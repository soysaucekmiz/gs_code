<?php
session_start();

include "funcs.php";
chkSsid();

// 1. GETデータ取得
$id = $_SESSION["id"];

//1.POSTでParamを取得
$name = $_POST["name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
$id = $_POST["id"];

// $file_name = $_FILES["upfile"]["name"];
// var_dump($file_name);

//****************************************************
//Fileアップロードチェック
//****************************************************
if (isset($_FILES["upfile"] ) && $_FILES["upfile"]["error"] ==0 ) {
    //情報取得
    $file_name = $_FILES["upfile"]["name"];         //"1.jpg"ファイル名取得
    $tmp_path  = $_FILES["upfile"]["tmp_name"]; //"/usr/www/tmp/1.jpg"アップロード先のTempフォルダ
    $file_dir_path = "upload/";  //画像ファイル保管先
    // var_dump($file_name);

    //***File名の変更***
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); //拡張子取得(jpg, png, gif)
    $uniq_name = date("YmdHis").md5(session_id()) . "." . $extension;  //ユニークファイル名作成
    $file_name = $file_dir_path.$uniq_name; //ユニークファイル名とパス
   
    $img="";  //画像表示orError文字を保持する変数
    // FileUpload [--Start--]
    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_name ) ) {
            chmod( $file_name, 0644 );
        } else {
            exit("Error:アップロードできませんでした。"); //Error文字
        }
    }
    // FileUpload [--End--]
}else{
    // var_dump($file_name);
    exit("画像が送信されていません"); //Error文字
}


//2.DB接続など
$pdo = db_connect();

// 3.UPDATE gs_an_table SET ....; で更新(bindValue)
// 基本的にinsert.phpの処理の流れです。
// $update = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg, image=:image WHERE id=:id";
$update = "UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, image=:image WHERE id=:id";
$stmt = $pdo->prepare($update);
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":lid", $lid, PDO::PARAM_STR);
$stmt->bindValue(":lpw", $lpw, PDO::PARAM_INT);
// $stmt->bindValue(":kanri_flg", $kanri_flg, PDO::PARAM_STR);
// $stmt->bindValue(":life_flg", $life_flg, PDO::PARAM_STR);
$stmt->bindValue(":image", $file_name, PDO::PARAM_STR);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();
header("Location: user_select.php");

?>
