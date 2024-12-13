<?php
namespace Service;

use Model\Reparation;
use PDO;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class ServiceReparation {
    private $pdo;

    public function connect() {
        $config = parse_ini_file('db_config.ini', true);
        $dsn = "mysql:host=" . $config['database']['host'] . ";dbname=" . $config['database']['dbname'];
        $username = $config['database']['username'];
        $password = $config['database']['password'];
        
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->log("INFO", "Database connection established");
        } catch (PDOException $e) {
            $this->log("ERROR", "Database connection failed: " . $e->getMessage());
        }
    }

    public function insertReparation(Reparation $reparation) {
        $stmt = $this->pdo->prepare("INSERT INTO Reparation (workshop_id, workshop_name, register_date, license_plate, photo_path, uuid) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([
            $reparation->getWorkshopId(),
            $reparation->getWorkshopName(),
            $reparation->getRegisterDate(),
            $reparation->getLicensePlate(),
            $reparation->getPhotoPath(),
            $reparation->getUuid()
        ])) {
            $this->log("INFO", "Reparation inserted successfully");
        } else {
            $this->log("ERROR", "Failed to insert reparation");
        }
    }

    public function getReparation($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Reparation WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function log($level, $message) {
        $log = new Logger('workshop');
        $log->pushHandler(new StreamHandler('logs/app_workshop.log', Logger::DEBUG));
        
        switch ($level) {
            case "INFO":
                $log->info($message);
                break;
            case "ERROR":
                $log->error($message);
                break;
            case "WARNING":
                $log->warning($message);
                break;
        }
    }
}
?>
