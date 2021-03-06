<?php
abstract class BaseCurl
{

    /**
     * getContents 
     * 引数に渡されたURLの配列かURLの文字列かで処理を分ける
     * 
     * @param mixed $url
     * @access public
     * @return void
     */
    public function getContents( $url )
    {
        if ( is_array($url) ) {
            $this->getMultiContents( $url );
        } else {
            $this->getSingleContents( $url );
        }
    }

    /**
     * getSingleContents 
     * cURLで指定されたURLのコンテンツを取得する
     * 
     * @param $url 
     * @access public
     * @return void
     */
    public function getSingleContents( $url )
    {
        $conn = curl_init( $url );
        $this->setCurlOption($conn);

        // cURLの実行
        $contents = curl_exec( $conn );

        $statusCode = curl_getinfo( $conn, CURLINFO_HTTP_CODE );
        if ( $statusCode < 300 && $statusCode >= 200 ) {
            // 通信成功時
            $this->success( $contents );
        } else {
            // 通信失敗時
            $this->fail();
        }
        curl_close( $conn );
    }

    /**
     * APIへの接続をマルチスレッドで行う
     */
    public function getMultiContents( $urlList )
    {
        // マルチハンドルの用意
        $multiHandle = curl_multi_init();

        // 複数のハンドルを保持する
        $handleList = array();

        // 指定されたURLをマルチハンドルに登録する
        foreach ( $urlList as $url ) {
            $handleList[$url] = curl_init( $url );
            $this->setCurlOption( $handleList[$url] );
            curl_multi_add_handle( $multiHandle, $handleList[$url] );
        }

        // 全ての処理が完了するまで待つ
        $running = null;
        while( true ) {
            if ( $running === 0) {
                break;
            }
            curl_multi_exec( $multiHandle, $running );
        }

        foreach( $urlList as $url ) {
            // ステータスコード
            $statusCode = curl_getinfo( $handleList[$url], CURLINFO_HTTP_CODE );
            if ($statusCode < 300 && $statusCode >= 200) {
                // 通信成功時
                $this->success( curl_multi_getcontent( $handleList[$url] ) );
            } else {
                // 通信失敗時
                $this->fail();
            }

            // ハンドルを閉じる
            curl_multi_remove_handle( $multiHandle,  $handleList[$url] );
            curl_close( $handleList[$url] );
        }

        curl_multi_close( $multiHandle );
    }

    /**
     * Curlのオプションを指定する
     */
    protected function setCurlOption( $maltiHundle )
    {
        // curl_exec()の結果を文字列として返す
        curl_setopt($maltiHundle, CURLOPT_RETURNTRANSFER, TRUE);

        // タイムアウトを1秒に設定
        curl_setopt($maltiHundle, CURLOPT_TIMEOUT, 1);
    }

    /**
     * 通信成功時の処理 
     */
    abstract protected function success( $content );

    /**
     * 通信失敗時の処理
     */
    abstract protected function fail();
}
