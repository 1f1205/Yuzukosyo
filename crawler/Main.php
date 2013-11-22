<?php

// Google Feed APIのURL
const GOOGLE_FEED_API = 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=%d&q=%s';
// 取得するページ数
const PAGE_NUM = 20;

function __autoload($class_name) {
    require_once $class_name . '.php';
}

$urlLists = selectRssTable();
$crawler = new Crawler();
$crawler->getMultiContents($urlLists);


function selectRssTable(){
    // テーブルを参照したとみなす
    //
    $urlList = array();

    array_push( $urlList, sprintf( GOOGLE_FEED_API, PAGE_NUM, "http://blog.livedoor.jp/nanjstu/index.rdf" ) );
    array_push( $urlList, sprintf( GOOGLE_FEED_API, PAGE_NUM, "http://hamusoku.com/index.rdf" ) );

    return $urlList;
}
