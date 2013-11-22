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

    /* Select分作成 */
    public function getSelectSql( $keyList = array() ){
        $sql = '';
        // 引数空の場合は*でひっぱってくる
        if( count( $keyList ) == 0 ){ $keyList = array( '*' ); }
        $keys = implode( ',', $keyList );
        $sql = 'SELECT ' . $keys . ' from ' . $this->table;

        return $sql;
    }

    /* Insert分作成 */
    public function getInsertSql( $keyList = array(), $valueList = array() ){
        // 対象のkeyの数とvalueの数があってない場合はreturn
        if( count( $keyList ) != count( $valueList ) ){ return 0; }
      
        $keys = implode( ',', $keyList );
        $values = implode( ',', $valueList );
        $sql = 'INSERT INTO ' . $this->table . ' (' . $keys . ') values (' . $values . ')';
    
        return $sql;
    }

    /* Update分作成 */
    public function getUpdateSql( $keyList, $valueList ){
        // 対象のkeyの数とvalueの数があってない場合はreturn
        if( count( $keyList ) != count( $valueList ) ){ return 0; }
      
        // set句内作成
        $set = array();
        for( $i=0; $i<count( $keyList ); $i++ ){
            $set[] = $keyList[$i] . ' = ' . $valueList[$i];
        }
        $sql = 'UPDATE ' . $this->table . ' SET ' . implode( ',', $set );
 
        return $sql;
    }

    /* Delete分作成 */
    public function getDeleteSql(){
        $sql = 'DELETE FROM ' . $this->table;
        return $sql;
    }

    /* PDOStatementオブジェクト返却 */
    public function query( $keys = array() ){
         if( count( $keys ) == 0 ){ $keys = array( '*' ); }
         $sql = 'SELECT ' . implode(',', $keys) . ' from ' . $this->table;
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
