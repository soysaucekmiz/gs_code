<?php
// 共通で使う関数

// DB接続
function db_connect(){
    try{
        return new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
    } catch (PDOExeption $e) {
        exit('DB_CONNECTION_ERROR:'.$e->getMessage());
    }
}

function sqlError($stmt){
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:".$error[2]);
}

function chkSsid(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()){
        exit("LOGIN ERROR");
    }else{
        session_regenerate_id(TRUE);
        $_SESSION["chk_ssid"] = session_id();
    }
}

function chkKanriFlg(){
    if($_SESSION["kanri_flg"]!=="1"){
        exit("LOGIN ERROR");
    }
}

?>