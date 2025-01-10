<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Model\Reparation;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Intervention\Image\ImageManager;

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

    public function insertReparation($workshopId, $workshopName, $registerDate, $licensePlate): Reparation
    {
        // Generar UUID
        $uuid = Ramsey\Uuid\Uuid::uuid4()->toString();

        // Generar texto para la marca de agua
        $watermarkText = $licensePlate . " - " . $uuid;

        // Instanciar ImageManager para procesar la imagen
        $manager = new \Intervention\Image\ImageManager();

        // Crear objeto de imagen desde el archivo cargado
        $image = $manager->make(data: $_FILES['photo']['tmp_name']);

        // Definir la ruta donde se guardará la imagen procesada
        $photoPath = 'resources/uploads/' . $_FILES['photo']['name'];

        // Agregar marca de agua
        $image->text(
            text: $watermarkText,
            x: 10,
            y: 20,
            callback: function ($font) {
                $font->file('resources/arial.ttf'); // Cambia esta ruta según tu fuente
                $font->size(20);
                $font->color([255, 0, 0, 0.7]); // Rojo con opacidad del 70%
                $font->align('left');
                $font->valign('top');
            }
        );

        // Guardar la imagen procesada
        $image->save($photoPath);

        // Insertar reparación en la base de datos
        $stmt = $this->mysqli->prepare("
            INSERT INTO Reparation (workshop_id, workshop_name, register_date, license_plate, photo_path, uuid)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            "isssss",
            $workshopId,
            $workshopName,
            $registerDate,
            $licensePlate,
            $photoPath,
            $uuid
        );

        if (!$stmt->execute()) {
            throw new Exception("Error al insertar la reparación: " . $stmt->error);
        }

        $stmt->close();

        // Retornar el modelo de reparación
        return new Reparation(
            $workshopId,
            $workshopName,
            $registerDate,
            $licensePlate,
            $photoPath,
            $uuid
        );
    }
}
