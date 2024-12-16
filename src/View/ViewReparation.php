<?php

use Model\Reparation;

class ViewReparation
{
    public function render(Reparation $model)
    {
        $workshop_id = $model->getWorkshopId();
        $workshop_name = $model->getWorkshopName();
        $work_register_date = $model->getRegisterDate();
        $liscense_plate = $model->getLicensePlate();
        $photo_path = $model->getPhotoPath();
        $uuid = $model->getUuid();
    }
}
