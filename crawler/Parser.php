<?php
class Parser extends BaseParser
{

    /**
     * 記事をパースする
     *
     * @param mixed $entry 記事1つ分
     * @access public
     * @return articleのオブジェクト
     */
    public function parseArticle($entry) {
        $article = StructYuzukosyo::$article;

        $article[ StructYuzukosyo::ARTICLE_TITLE ] = $entry->title;
        $article[ StructYuzukosyo::ARTICLE_LINK ]  = $entry->link;
        $article[ StructYuzukosyo::ARTICLE_PUBLISHED_DATE ] = $entry->publishedDate;
        $article[ StructYuzukosyo::ARTICLE_CONTENT ]    = $entry->content;
        $article[ StructYuzukosyo::ARTICLE_CATEGORIES ] = $entry->categories;

        return $article;
    }
}
