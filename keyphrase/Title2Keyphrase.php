<?php
require_once('./KeyphraseAPI.php');

class Title2KeyPhrase
{
    private $keyApiObj;

    public function __construct() {

        $this->keyApiObj = new KeyphraseAPI();

    }
    
    public function execute($appId, $sentence) {

        // RequestURL生成
        $requestUrl = $this->keyApiObj->replaceURL($appId, $sentence);
        
        // APIからレスポンス取得
        $responseXml = $this->keyApiObj->getAPIResponse($requestUrl);
        
        // レスポンスXMLからkeyphraseを抽出
        $keyphrases = $this->keyApiObj->extractKeyphrase($responseXml);

        return $keyphrases;
    }

}
