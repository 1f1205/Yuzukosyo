<?php
require_once("./OperationDb.php");

Class DbUtil extends OperationDb
{
    public function __construct( $database, $user, $pass, $table ){
         parent::__construct($database, $user, $pass );
         $this->table    = $table;
    }

    public function setTable(){
         parent::setTable( $this->table );
    }
        
    public function execute( $key, $value, $fieldList = array() ){
        // チェック対象キーがわたってこない場合、返却
        if( 0 == count( $key ) ){ return false; }
       
        $this->setTable();
        $sql    = parent::getSelectSql( $fieldList ) . parent::getWhereEqual( $key, $value );
        $stmt   = parent::query( $sql );
        $result = parent::fetch( $stmt );

        return $result;
    }
}
