<?php

namespace App\Controllers;

use App\Models\SolicitudModel;

class Home extends BaseController
{
    public function index(): string
    {   // Obtiene la informacion que consulta en la bbdd 
        $solicitudModel = new SolicitudModel();
        $solicitudes = $solicitudModel->solicitudes();
        //Se envia la informacion a home
        return view('home',['solicitudes' => $solicitudes]);
    }
}
