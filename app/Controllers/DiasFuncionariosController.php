<?php

namespace App\Controllers;

use App\Controllers\view;
use App\Models\DiasFuncionarioModel;


class DiasFuncionariosController extends BaseController
{
    //funciones para mostrar la tabla dias funcionarios
    public function getAll()
    {
        $model = new DiasFuncionarioModel();
        $data = $model->getDias();
        return $this->response->setContentType('application/json')->setBody($data);
    }

    public function getDiasByRut($rut_funcionario)
    {
        $model = new DiasFuncionarioModel();
        $data = $model->getDiasByRut($rut_funcionario);
        return $this->response->setContentType('application/json')->setBody($data);
    }

}