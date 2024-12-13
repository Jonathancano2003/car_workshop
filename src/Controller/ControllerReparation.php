<?php
namespace Controller;

use Service\ServiceReparation;
use Intervention\Image\ImageManagerStatic as Image;
use Ramsey\Uuid\Guid\Guid;
use Model\Reparation;

class ControllerReparation {
    private $service;

    public function __construct() {
        $this->service = new ServiceReparation();
        $this->service->connect();
    }

    public function insertReparation($data) {
        $uuid = Guid::uuid4()->toString();
        $photo_path = $this->processImage($data['license_plate'], $data['photo']); // Assuming the photo is uploaded

        $reparation = new Reparation(
            $data['workshop_id'],
            $data['workshop_name'],
            $data['register_date'],
            $data['license_plate'],
            $photo_path,
            $uuid
        );

        $this->service->insertReparation($reparation);
        return $uuid; // Return reparation ID after registration
    }

    public function getReparation($id) {
        $reparation = $this->service->getReparation($id);
        return $reparation;
    }

    private function processImage($license_plate, $image) {
        $imagePath = '/uploads/' . $license_plate . '.jpg'; // Save path
        $imageObj = Image::make($image);
        $watermarkText = $license_plate . ' ' . $uuid;
        $imageObj->text($watermarkText, 10, 10, function($font) {
            $font->file('path/to/font.ttf');
            $font->size(24);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('top');
        });
        $imageObj->save($imagePath);
        return $imagePath;
    }
}
?>
