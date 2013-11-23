<?php
require_once('./KeyphraseAPI.php');

class Title2KeyPhrase
{
    
    public function execute($appId, $sentence) {

        // オブジェクト生成
        $keyApiObj = new KeyphraseAPI();
        
        // RequestURL生成
        $requestUrl = $keyApiObj->replaceURL($appId, $sentence);
        
        // APIからレスポンス取得
        $responseXml = $keyApiObj->getAPIResponse($requestUrl);
        
        // レスポンスXMLからkeyphraseを抽出
        $keyphrases = $keyApiObj->extractKeyphrase($responseXml);

        return $keyphrases;
    }

}
