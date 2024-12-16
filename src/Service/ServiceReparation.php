<?php
use Model\Reparation;
class ServiceReparation {
    private $mysqli;
    function getDatabaseConnection() {
        $config = parse_ini_file('config.ini', true);
    
        if (!$config || !isset($config['database'])) {
            die('No se pudo cargar la configuración de la base de datos.');
        }
    
        $dbConfig = $config['database'];
        $host = $dbConfig['host'];
        $username = $dbConfig['username'];
        $password = $dbConfig['password'];
        $dbname = $dbConfig['dbname'];
    
        $mysqli = new mysqli($host, $username, $password, $dbname);
    
        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }
    
        return $mysqli;
    }
    
    public function getReparation($role, $idReparation): Reparation {
        $stmt = $this->mysqli->prepare("SELECT * FROM reparation WHERE idReparation = ?");
        $stmt->bind_param("s", $idReparation);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        $stmt->close();

        $reparation = new Reparation(
            $result['idWorkshop'],    
            $result['nameWorkshop'],   
            $result['registerDate'], 
            $result['licensePlate'],   
            $result['photoVehicle'],  
            $result['idReparation']    
        );

        return $reparation;
    }
}