<?php
class StructYuzukosyo
{
    const ARTICLE_TITLE          = 'title'; // 記事タイトル
    const ARTICLE_LINK           = 'link'; // 記事リンク
    const ARTICLE_PUBLISHED_DATE = 'published_date'; // 記事の入稿時間
    const ARTICLE_CONTENT        = 'content'; //  記事の要約
    const ARTICLE_CATEGORIES     = 'categories'; // 記事カテゴリ
    const ARTICLE_RSS_ID         = 'rss_info_id'; // 記事の取得元

    public static $article = array(
        self::ARTICLE_TITLE,
        self::ARTICLE_LINK,
        self::ARTICLE_PUBLISHED_DATE,
        self::ARTICLE_CONTENT,
        self::ARTICLE_CATEGORIES,
        self::ARTICLE_RSS_ID
    );

}
