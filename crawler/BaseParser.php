<?php

abstract class BaseParser
{

    /**
     * 引数をループしパースする
     *
     * @param array $decodeContent APIのレスポンスをデコードしたデータの配列
     * @access public
     * @return array パースされたデータの配列
     */
    public function parse($decodeContent) {
        $datas = array();

        foreach ($decodeContent as $entry) {
            array_push($datas, $this->parseArticle($entry));
        }

        return $datas;
    }

    /**
     * データをパースする
     */
    abstract protected function parseArticle($entry);

}
