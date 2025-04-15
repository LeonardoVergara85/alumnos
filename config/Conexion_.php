<?php

include_once 'adodb/adodb.inc.php';
include_once 'adodb/adodb-exceptions.inc.php';



class Conexion{

    function __construct() {
        try {

            $this->db = NewADOConnection('mysqli');
            // $this->db->Connect("mysql.hostinger.com.ar", "u622404615_alumnos", "Skills_2021++", "u622404615_alumnos");
            //$this->db->Connect("localhost", "root", "", "alumnos");
            $this->db->Connect("localhost", "root", "", "alumnos");
            
            if ( !isset($_SESSION) ) {
                session_start();
            }

            $sql = "SET NAMES 'utf8'";
            $this->db->Execute($sql);
		
	    $sql_ = "SET time_zone = '-3:00'";
            $this->db->Execute($sql_);

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