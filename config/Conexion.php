<?php
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');
include_once __DIR__ . '/adodb/adodb.inc.php';
include_once __DIR__ . '/adodb/adodb-exceptions.inc.php';

class Conexion {

    public $host_usado;
    public $db;

    function __construct() {
        try {
            if (function_exists('mysqli_report')) {
                mysqli_report(MYSQLI_REPORT_OFF);
            }

            $this->db = NewADOConnection('mysqli');

            // Host por defecto
            $hostDNS = 'localhost';
            $hostIP = '127.0.0.1:3306';

            // Intentar resolver DNS
            $ip = gethostbyname($hostDNS);

            if ($ip === $hostDNS) {
                // Falló DNS, usar IP
                $host = $hostIP;
            } else {
                // DNS funciona
                $host = $hostDNS;
            }

            $this->host_usado = $host;

            // Conexión
            $this->db->Connect($host, "root", "", "alumnos");

            if (!isset($_SESSION)) {
                session_start();
            }

            $this->db->Execute("SET NAMES 'utf8'");
            $this->db->Execute("SET time_zone = '-3:00'");

            // Log de conexión (opcional)
            $this->logConexion($host);

            return $this->db;

        } catch (Exception $e) {
            var_dump('#Error al conectarse con la base de datos#');
            adodb_backtrace($e->getTrace());
        }
    }

    private function logConexion($host) {
        if (!isset($_SESSION['conexion_log_escrito'])) {
            $log = date('Y-m-d H:i:s') . " - Conexión usada: $host\n";
            $logPath = realpath(__DIR__ . '/../logs') . '/conexion_log.txt';
            file_put_contents($logPath, $log, FILE_APPEND);
            $_SESSION['conexion_log_escrito'] = true;
        }
    }
}
?>