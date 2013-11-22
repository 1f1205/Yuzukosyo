<?php
class Parser extends BaseParser {

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
