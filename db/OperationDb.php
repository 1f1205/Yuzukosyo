<?php

class OperationDb
{
    // $engin(よくわからんけどmysql以外使うかつpdoで食えるものがあるときよう）
    private $engine = 'mysql';

    // ホスト名(default:localhost)
    private $host = 'localhost';
    
    // 接続先データベース名
    private $databese = '';

    // user名
    private $user = '';

    // password
    private $pass = '';

    // 接続テーブル名
    private $table='';

    // pdoObject
    private $dbh = null;

    // コンストラクタ
    public function __construct( $database, $user, $pass, $host = '' ){
        // host名が入ってたら入れ直す（まぁ、多分使わん）
        if( '' != $host ){ $this->host = $host; }
        $this->database = $database;
        $this->user     = $user;
        $this->pass     = $pass;

        try{
            $dsn = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host; 
            $this->dbh = new PDO( $dsn, $this->user, $this->pass ); 
        }catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }
    }

    // table名設定
    public function setTable( $name ){
        $this->table = $name;
    }

    // key設定
    public function makeKey( $key ){
        // keyが空の場合*を返却
        if( empty( $key ) ){ return '*'; }
        $targetKey = '';
        // 引数にあわせて取得キー作成
        if( is_array( $key ) ){
            // 引数が配列の場合、カンマ区切り
            $targetKey = implode( ',', $key );
        }else{
            // 引数がstringの場合、そのまんま
            $targetKey = $key;
        }
        return $targetKey;
    }

    // key,value設定
    public function makeKeyValue( $key, $value ){
        $targetKey = '';
        $targetValue = '';
        if( is_array( $key ) ){
            // 引数が配列の場合、カンマ区切り
            $targetKey = implode( ',', $key );
            $targetValues = implode( ',', $value );
        }else{
            // 引数がstringの場合、そのまんま
            $targetKey = $key;
            $targetValue = $value;
        }
        return array( $targetKey, $targetValue );
    }

    /* 比較句作成 */
    public function comparePhrase( $key, $value ){
        // 対象のkeyの数とvalueの数があってない場合はreturn
        if( count( $key ) != count( $value ) ){ return 0; }
      
        // 比較句内作成
        // todo 比較演算子の種類増やす（引数判断）
        $compareArray = array();
        if( is_array( $key ) ){
            // 引数が配列の場合
            for( $i=0; $i<count( $key ); $i++ ){
                $compareArray[] = $key[$i] . ' = ' . $value[$i];
            }
        }else{
                $compareArray[] = $key . ' = ' . $value;
        }
        return implode( ',', $compareArray );
    }

    /* Select分作成 */
    public function getSelectSql( $key ){
        $sql = '';
        $targetKey = $this->makeKey( $key );
        $sql = 'SELECT ' . $targetKey . ' from ' . $this->table;

        return $sql;
    }

    /* Insert分作成 */
    public function getInsertSql( $key, $value ){
        // 対象のkeyの数とvalueの数があってない場合はreturn
        if( count( $key ) != count( $value ) ){ return 0; }
        list( $tartgetKey, $targetValue ) = $this->makeKeyValue( $key, $value ); 
        $sql = 'INSERT INTO ' . $this->table . ' (' . $targetKey . ') values (' . $targetValue . ')';
    
        return $sql;
    }

    /* Update分作成 */
    public function getUpdateSql( $key, $value ){
        $setPhrase = $this->comparePhrase( $key, $value );
        $sql = 'UPDATE ' . $this->table . ' SET ' . $setPhrase;

        return $sql;
    }

    /* Delete分作成 */
    public function getDeleteSql(){
        $sql = 'DELETE FROM ' . $this->table;
        return $sql;
    }

    /* where $key=$valueを作成 */
    public function getWhereEqual( $key, $value ){
        $wherePhrase = $this->comparePhrase( $key, $value );
        $sql = ' where ' . $wherePhrase;
 
        return $sql;
    }


    /* PDOStatementオブジェクト返却 */
    public function query( $sql ){
         $stmt = $this->dbh->query( $sql );

         return $stmt;
    }

    /* データ取得 */
    public function fetch( $stmt ){
         $rtnData = array();
         while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $rtnData[] = $data;
         }
         return $rtnData;
    }

}
