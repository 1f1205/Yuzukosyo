<?php

class KeyphraseAPI
{

    private $apiUrl;

    public function __construct() {

        $this->apiUrl
            = 'http://jlp.yahooapis.jp/KeyphraseService/V1/extract'
            . '?appid=%s'
            . '&sentence=%s';

    }

    public function replaceUrl($appId, $sentence) {

        $replacedUrl = sprintf($this->apiUrl, $appId, $sentence);
        return $replacedUrl;

    }

    public function getAPIResponse($url) {

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        // TODO HTTPResponseのstatus確認
        // curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch); 
        curl_close($ch); 

        return $response;
    }

    public function extractKeyphrase($xml) {

        // XML読み込み
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse = true;
        $dom->loadXML($xml);

        // keyphrase取得
        $keyphrases = array();
        $resultsetNode = $dom->getElementsByTagName("ResultSet")->item(0);

        $resultNode = $resultsetNode->getElementsByTagName("Result");
        foreach ($resultNode as $result) {
            $keyphrase = $result->getElementsByTagName("Keyphrase")->item(0)->nodeValue;
            array_push($keyphrases, $keyphrase);
        }

        return $keyphrases;

    }

}
