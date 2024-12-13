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

    // Getter and Setter methods for each property
}
?>