<?php
namespace Model;

class Reparation {
    private $workshop_id;
    private $workshop_name;
    private $register_date;
    private $license_plate;
    private $photo_path;
    private $uuid;

    public function __construct($workshop_id, $workshop_name, $register_date, $license_plate, $photo_path, $uuid) {
        $this->workshop_id = $workshop_id;
        $this->workshop_name = $workshop_name;
        $this->register_date = $register_date;
        $this->license_plate = $license_plate;
        $this->photo_path = $photo_path;
        $this->uuid = $uuid;
    }

    public function getWorkshopId() {
        return $this->workshop_id;
    }

    public function setWorkshopId($workshop_id) {
        $this->workshop_id = $workshop_id;
    }

    public function getWorkshopName() {
        return $this->workshop_name;
    }

    public function setWorkshopName($workshop_name) {
        $this->workshop_name = $workshop_name;
    }

    public function getRegisterDate() {
        return $this->register_date;
    }

    public function setRegisterDate($register_date) {
        $this->register_date = $register_date;
    }

    public function getLicensePlate() {
        return $this->license_plate;
    }

    public function setLicensePlate($license_plate) {
        $this->license_plate = $license_plate;
    }

    public function getPhotoPath() {
        return $this->photo_path;
    }

    public function setPhotoPath($photo_path) {
        $this->photo_path = $photo_path;
    }

    public function getUuid() {
        return $this->uuid;
    }

    public function setUuid($uuid) {
        $this->uuid = $uuid;
    }
}


?>