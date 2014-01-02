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

//$dao->setCondition('where','tag_id', 1);
//$dao->setCondition('where','tag_id', '>', 3);

//select
$c=$dao->execute('select');

//insert
//$c=$dao->execute('insert',array('tag_id'=>13));

//where
//delete
//$c=$dao->execute('delete');

//update
//$c=$dao->execute('update',array('tag_name'=>'aiue'));

var_dump($c);
