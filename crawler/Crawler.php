<?php
class Crawler {

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

    private function fileGet($url) {
        $this->parse(file_get_contents($url));
    }

    private function parse($content) {
        $decode = json_decode($content)->responseData->feed;

        // 記事をパース
        $parser = new Parser();
        $arrays = $parser->parse($decode->entries);

        var_dump($arrays);
    }

    private function selectRssTable() {
        return "https://ajax.googleapis.com/ajax/services/feed/load?v=1.0&q=http://blog.livedoor.jp/nanjstu/index.rdf&num=20";
    }
}
