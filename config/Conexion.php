<?php

include_once 'adodb/adodb.inc.php';
include_once 'adodb/adodb-exceptions.inc.php';



class Conexion{

    function __construct() {
        try {

            $this->db = NewADOConnection('mysql');
            $this->db->Connect("localhost", "root", "", "skills");
            
            if ( !isset($_SESSION) ) {
                session_start();
            }

            $sql = "SET NAMES 'utf8'";
            $this->db->Execute($sql);

            // if ( isset($_SESSION['usuario']) ) {
                
            //     $docu = $_SESSION['usuario'];
            
            //     $stmt = $this->db->Prepare("BEGIN DBMS_SESSION.SET_IDENTIFIER(:DOCU); END;");
            //     $this->db->InParameter($stmt, $docu, 'DOCU');
            //     $this->db->Execute($stmt);

            // }
            
            

            return $this->db;

        } catch (exception $e) {
            adodb_backtrace($e->gettrace());
        }
    }
}
	
?>