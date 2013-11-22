<?php

abstract class BaseParser
{

    /**
     * 引数でしていされた記事の配列をループし、
     * パースする
     */
    public function parse($jsonDecodeContent) {
        $articles = array();

        foreach ($jsonDecodeContent as $entry) {
            array_push($articles, $this->parseArticle($entry));
        }

        return $articles;
    }

    /**
     * 記事情報をパースする
     */
    abstract protected function parseArticle($entry);

}
