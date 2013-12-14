<?php
require_once("./OperationDb.php");

Class DbUtil extends OperationDb
{
    // 条件式とかいれとくやつ
    private $condition = null;

    // tableはあった場合セット
    public function __construct( $database, $user, $pass, $table = '' ){
         parent::__construct($database, $user, $pass );
         if( '' != $table ){ parent::setTable( $table ); }
    }

    // 条件設定(where,order)など拡張予定
    //todo type=(where,orederなど),condition=(=,<,>などの比較系とか)の実装
    public function setCondition( $type, $key, $value, $condition = '=' )
    {
        $this->condition = parent::getWhereEqual( $key, $value );
    }

    // 実行メソッド
    public function execute( $fieldList = array() )
    {
        $sql    = parent::getSelectSql( $fieldList ) . $this->condition;
        $stmt   = parent::query( $sql );
        $result = parent::fetch( $stmt );

        return $result;
    }
}
