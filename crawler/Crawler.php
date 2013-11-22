<?php
class Crawler extends BaseCrawler {
    /**
     * 通信成功時の処理
     */
    protected function success( $content ){
        $decode = json_decode( $content )->responseData->feed;

        // 記事をパース
        $parser = new Parser();
        $arrays = $parser->parse( $decode->entries );

        // TODO この後に特徴語を抽出
        // DBに格納
    }

    /**
     * 通信失敗時の処理
     */
    protected function fail(){
        // 今は特に何もしない
    }
}
