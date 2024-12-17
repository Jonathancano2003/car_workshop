<?php

require_once 'src/Service/ServiceReparation.php';

$serviceReparation = new ServiceReparation();

if ($serviceReparation->checkConnection()) {
    echo "Conexión exitosa a la base de datos.";
} else {
    echo "Error al conectar con la base de datos.";
}
