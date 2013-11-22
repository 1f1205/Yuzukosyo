<?php
require_once("./OperationDb.php");

// ユーザ名
$user = "user";
// pass
$pass = "pass";
// データベース
$database = 'data_test';
// テーブル
$table = 'rank';
// キー
$keys = array( 'id' );

// object
$dao=new OperationDb($database,$user,$pass);
// テーブル名設定
$dao->setTable( $table );
// PDOStatementオブジェクト取得
$stmt=$dao->query();
// データ取得
$data=$dao->fetch($a);
var_dump($data);
