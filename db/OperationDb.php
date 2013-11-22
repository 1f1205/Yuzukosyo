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

    // key名（操作するフィールド）
    private $keys = array();

    // value名(操作対象の値)
    private $values = array();

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

    /* まだ、使えま１０ 
    function select( $keys = array() ){
         $rtnData = array();
         if( count( $keys ) == 0 ){ $keys = array( '*' ); }
         $sql = 'SELECT ' . implode(',', $keys) . ' from ' . $this->table;

         foreach( $this->dbh->query( $sql ) as $row) {
             $rtnData = $row;
         }
         return $rtnData;
    }

    function insert( $dbh, $table, $keys = array(), $values = array() ){
         $dbh->query('INSERT INTO rank (id, score) values (' . $id . ',' . $score . ')');
    }*/

    /* PDOStatementオブジェクト返却 */
    function query( $keys = array() ){
         if( count( $keys ) == 0 ){ $keys = array( '*' ); }
         $sql = 'SELECT ' . implode(',', $keys) . ' from ' . $this->table;
         $stmt = $this->dbh->query( $sql );

         return $stmt;
    }

    /* データ取得 */
    function fetch( $stmt ){
         $rtnData = array();
         while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
             $rtnData[] = $data;
         }
         return $rtnData;
    }

}
