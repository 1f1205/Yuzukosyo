<?php
class Parser extends BaseParser {

    /**
     * 記事をパースする
     *
     * @param mixed $entry 
     * @access public
     * @return void
     */
    public function parseArticle($entry) {
        $articleModel = new ArticleModel();

        $articleModel->title = $entry->title;
        $articleModel->link = $entry->link;
        $articleModel->publishedDate = $entry->publishedDate;
        $articleModel->content = $entry->content;
        $articleModel->categories = $entry->categories;

        return $articleModel;
    }
}
