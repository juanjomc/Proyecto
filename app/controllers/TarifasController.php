<?php
require '../app/models/TarifasModel.php';

class TarifasController {
    public function obtenerTarifas() {
        $model = new TarifasModel();
        $tarifas = $model->getTarifas();
        echo json_encode($tarifas);
    }
}