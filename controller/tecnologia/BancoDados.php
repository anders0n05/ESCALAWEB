<?php

class BancoDados {

    private static $sqlsvr = true;
    private static $host = "DB02.OLLOGISTICA.COM.BR";
    private static $nome = "HOMOLOGACAO";
    private static $usuario = "escalaweb";
    private static $senha = "#escala@web";	
    private static $mascaraDataHora = "Y-m-d H:i";
    private static $mascaraData = "Y-m-d";
    private static $isolationLevel = PDO::SQLSRV_TXN_READ_UNCOMMITTED; 
    private static $TnsOracle = "
							(DESCRIPTION =
    						(ADDRESS_LIST =
    						  (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
   						 )
    						(CONNECT_DATA =
    						  (SERVICE_NAME = orcl)
    						)
  						)
       					";

    private function __construct() {
        
    }

    public static function getDns() {
        if (self::$sqlsvr) {
            return "sqlsrv:Server=" . self::$host . ";Database=" . self::$nome . ";ConnectionPooling=0; TransactionIsolation=" . self::$isolationLevel;
        } else {
            return "oci:dbname" . self::$TnsOracle;
        }
    }

    public static function getUsuario() {
        return self::$usuario;
    }

    public static function getSenha() {
        return self::$senha;
    }

    public static function getMascaraData() {
        return self::$mascaraData;
    }

    public static function getMascaraDataHora() {
        return self::$mascaraDataHora;
    }

}
