<?php
 /**
 * 
 */
 class Respaldos
 {
 	/**
 	 * Variable de Conexion a BD
 	 * @var [Conexion]
 	 */
 	protected $DB;

 	/**
 	 * Variables de la Tabla
 	 */

 
 	function __construct()
 	{
 		$database = new Conexion();
 		$this->DB = $database->db;
 	}


public function Respaldar() {
    try {
        $backupSQL = "-- Respaldo de la Base de Datos\n";
        $backupSQL .= "-- Fecha: " . date("d-m-Y H:i:s") . "\n\n";
        
        // Obtener tablas (excluyendo vistas)
        $tables = [];
        $result = $this->DB->Execute("SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'");
        while ($row = $result->FetchRow()) {
            $tables[] = $row[0];
        }

        // Obtener vistas
        $views = [];
        $result = $this->DB->Execute("SHOW FULL TABLES WHERE Table_type = 'VIEW'");
        while ($row = $result->FetchRow()) {
            $views[] = $row[0];
        }

        // Respaldar estructura y datos de las tablas
        foreach ($tables as $table) {
            try {
                // Obtener estructura de la tabla
                $structure = $this->DB->Execute("SHOW CREATE TABLE `$table`")->FetchRow();
                $backupSQL .= "-- Estructura de tabla `$table`\n";
                $backupSQL .= $structure['Create Table'] . ";\n\n";

                // Obtener datos de la tabla
                $rows = $this->DB->Execute("SELECT * FROM `$table`");
                $insertStatements = [];

                // while ($row = $rows->FetchRow()) {
                //     $values = array_map([$this->DB, 'qstr'], $row);
                //     $insertStatements[] = "(" . implode(", ", $values) . ")";
                // }
                // while ($row = $rows->FetchRow()) {
                //     $assocRow = array_slice($row, 0, count($row) / 2); // solo los primeros N
                //     $values = array_map([$this->DB, 'qstr'], $assocRow);
                //     $insertStatements[] = "(" . implode(", ", $values) . ")";
                // }
                // while ($row = $rows->GetRowAssoc(0)) { // solo asociativos
                //     $values = array_map([$this->DB, 'qstr'], $row);
                //     $insertStatements[] = "(" . implode(", ", $values) . ")";
                // }
                while ($row = $rows->FetchRow()) {
                    // Elimina claves numéricas
                    $assocRow = array_filter($row, function($key) {
                        return !is_int($key);
                    }, ARRAY_FILTER_USE_KEY);
                
                    $values = array_map([$this->DB, 'qstr'], $assocRow);
                    $insertStatements[] = "(" . implode(", ", $values) . ")";
                }
                
                if (!empty($insertStatements)) {
                    $backupSQL .= "INSERT INTO `$table` VALUES " . implode(",\n", $insertStatements) . ";\n\n";
                }

                // Obtener claves foráneas y auto_increment
                $constraints = $this->DB->Execute("SHOW CREATE TABLE `$table`")->FetchRow();
                preg_match_all('/CONSTRAINT.*FOREIGN KEY.*REFERENCES.*/', $constraints['Create Table'], $foreignKeys);
                preg_match('/AUTO_INCREMENT=\d+/', $constraints['Create Table'], $autoIncrement);

                if (!empty($foreignKeys[0])) {
                    foreach ($foreignKeys[0] as $fk) {
                        $backupSQL .= "ALTER TABLE `$table` ADD $fk;\n";
                    }
                    $backupSQL .= "\n";
                }

                if (!empty($autoIncrement)) {
                    $backupSQL .= "ALTER TABLE `$table` " . $autoIncrement[0] . ";\n\n";
                }

            } catch (Exception $e) {
                $backupSQL .= "-- ERROR al respaldar la tabla `$table`: " . $e->getMessage() . "\n\n";
            }
        }

        // Respaldar vistas
        foreach ($views as $view) {
            try {
                $structure = $this->DB->Execute("SHOW CREATE VIEW `$view`")->FetchRow();
                $backupSQL .= "-- Estructura de vista `$view`\n";
                $backupSQL .= $structure['Create View'] . ";\n\n";
            } catch (Exception $e) {
                $backupSQL .= "-- ERROR al respaldar la vista `$view`: " . $e->getMessage() . "\n\n";
            }
        }

        return $backupSQL;

        } catch (Exception $e) {
            return 'ERROR: ' . $e->getMessage();
     }
    }

    public function registrarRespaldo(){
        
        $sql = "INSERT INTO `respaldos` (`id`, `estado`, `fecha`) VALUES (NULL, 'OK', NOW())";
    
        $this->DB->Execute($sql);
    
    	return true;
    }
    
    public function getRespaldo(){
    	
    	try {

			$sql = "SELECT id, estado, date_format(fecha,'%d/%m/%Y %H:%m hs.') AS fecha FROM `respaldos` ORDER BY fecha DESC LIMIT 1";

		   $this->DB->SetFetchMode(ADODB_FETCH_ASSOC);

			$stmt = $this->DB->Prepare($sql);
			
		   $filas = $this->DB->Execute($stmt);

		   return $filas;


		} catch (Exception $e) {
			
			print_r('MODEL: ' . $e);

		}
    }
 
	// fin del modelo
}
    