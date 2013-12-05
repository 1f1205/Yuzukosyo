<?php
/**
 * 実行時のサンプルコード 
 */

// Google Feed APIのURL
const GOOGLE_FEED_API = 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=%d&q=%s';
// 取得するページ数
const PAGE_NUM = 20;

function __autoload($class_name) 
{
    require_once $class_name . '.php';
}


//  複数URL実行時
/**
$urlLists = selectRssTable();
$crawler = new Crawler();
$crawler->getContents($urlLists);
 */

// URL単体実行時
$url = getUrl();
$crawler = new Crawler();
$crawler->getContents( $url );

function getUrl() 
{
    return sprintf( GOOGLE_FEED_API, PAGE_NUM, "http://blog.livedoor.jp/nanjstu/index.rdf" );
}

function selectRssTable()
{
    // テーブルを参照したとみなす
    //
    $urlList = array();

    array_push( $urlList, sprintf( GOOGLE_FEED_API, PAGE_NUM, "http://blog.livedoor.jp/nanjstu/index.rdf" ) );
    array_push( $urlList, sprintf( GOOGLE_FEED_API, PAGE_NUM, "http://hamusoku.com/index.rdf" ) );

    return $urlList;
}
