<?php
require_once('./KeyphraseAPI.php');

$API_REQUEST_URL = 'http://jlp.yahooapis.jp/KeyphraseService/V1/extract?appid=<APPID>&sentence=<SENTENCE>';

# 引数のエラーチェック
if ($argc != 3) {
    print "Usage: php extractKeyphrase.php <appid> <sentense> \n";
    exit();
}
$appid = $argv[1];
$sentence = $argv[2];

# オブジェクト生成
$kapi = new KeyphraseAPI($API_REQUEST_URL);

# RequestURL生成
$request_url = $kapi->replaceURL($appid, $sentence);

# APIからレスポンス取得
$response_xml = $kapi->getAPIResponse($request_url);

# TODO HTTPResponseのstatus確認

# レスポンスXMLからkeyphrase, scoreを抽出
$keyphrases = $kapi->extractKeyphrase($response_xml);

# keyphrase表示
foreach ($keyphrases as $keyphrase) {
    echo $keyphrase . "\n";
}

