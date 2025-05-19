<?php
require '../app/models/TarifasModel.php';

class TarifasController {
    public function obtenerTarifas() {
        $model = new TarifasModel();
        $tarifas = $model->getTarifas();

        // Convertir a array asociativo y ajustar la clave 'domingos' a 'domingo'
        $result = [];
        foreach ($tarifas as $tarifa) {
            $clave = $tarifa['opcion'] === 'domingos' ? 'domingo' : $tarifa['opcion'];
            $result[$clave] = $tarifa['valor'];
        }

        echo json_encode($result);
    }
}