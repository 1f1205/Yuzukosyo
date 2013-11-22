<?php

class KeyphraseAPI
{

    private $api_url;

    public function KeyphraseAPI($api_defaulat_url) 
    {
        $this->api_url = $api_defaulat_url;
    }

    public function replaceUrl($appid, $sentence)
    {
        $replaced_url = str_replace('<APPID>', $appid, $this->api_url);
        $replaced_url = str_replace('<SENTENCE>', $sentence, $replaced_url);

        return $replaced_url;
    }

    public function getAPIResponse($url) 
    {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        # TODO HTTPResponseのstatus確認用
        # curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch); 
        curl_close($ch); 

        return $response;
    }

    public function extractKeyphrase($xml)
    {
        # XML読み込み
        $dom = new DOMDocument('1.0', 'UTF-8');
        $dom->preserveWhiteSpace = false;
        $dom->validateOnParse = true;
        $dom->loadXML($xml);

        # keyphrase取得
        $keyphrases = array();
        $resultset_node = $dom->getElementsByTagName("ResultSet")->item(0);

        $result_node = $resultset_node->getElementsByTagName("Result");
        foreach ($result_node as $result) {
            $keyphrase = $result->getElementsByTagName("Keyphrase")->item(0)->nodeValue;
            array_push($keyphrases, $keyphrase);
        }

        return $keyphrases;
    }
}
