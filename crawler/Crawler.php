<?php
class Crawler {
    // Google Feed APIのURL
    const GOOGLE_FEED_API = 'https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=%d&q=%s';
    // 取得するページ数
    const PAGE_NUM = 20;

    /**
     * 実行ファイルから呼び出す 
     *
     * @access public
     * @return void
     */
    public function exec() {
        echo "test";

        $urls = $this->selectRssTable();

        $this->fileGet($urls);
    }

    /**
     * jsonファイルを取得する 
     *
     * @param mixed $url 
     * @access private
     * @return void
     */
    private function fileGet($url) {
        $this->parseJson(file_get_contents($url));
    }
    
    /**
     * jsonファイルをパースし、配列を返す
     *
     * @param mixed $content 
     * @access private
     * @return void
     */
    private function parseJson($content) {
        $decode = json_decode($content)->responseData->feed;

        // 記事をパース
        $parser = new Parser();
        $arrays = $parser->parse($decode->entries);

        var_dump($arrays);
    }

    private function selectRssTable() {
        return sprintf(self::GOOGLE_FEED_API, self::PAGE_NUM, "http://blog.livedoor.jp/nanjstu/index.rdf");
    }
}
