<?php

use Model\Reparation;

class ServiceReparation
{
    private $mysqli;

    function __construct()
    {
        $this->mysqli = $this->connect();
    }

    function connect()
    {
        $config =  parse_ini_file('cfg/db_config.ini', true);
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

    public function getReparation($role, $idReparation)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM reparation WHERE idReparation = ?");
        $stmt->bind_param("i", $idReparation);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($result) {
            $reparation = new Reparation(
                $result['idWorkshop'],
                $result['workshop_name'],
                $result['register_date'],
                $result['license_plate'],
                $result['photo_path'],
                $result['idReparation']
            );
            return $reparation;
        }
    }
    public function checkConnection(): bool
    {
        $result = $this->mysqli->query("SELECT 1");  // Realiza una consulta simple

        return $result !== false;  // Retorna true si la consulta fue exitosa
    }
}
