<?php
require_once( './DbUtil.php' );
$user = "user";
$pass = "pass";
$database = 'database';

// newのときにdataセット
$a=new DbUtil( $database,$user,$pass,'pre_tags' );
//$a->execute( array( 'pre_tag_id' ), array( 1 ), 'article_count' );
//$a->execute( array( 'pre_tag_id' ), array( 1 ));
//$a->execute( 'pre_tag_id', 1, 'article_count' );
$result=$a->execute( 'pre_tag_id', 1);
var_dump($result);
