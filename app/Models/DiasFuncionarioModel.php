<?php

namespace App\Models;

use CodeIgniter\Model;

class DiasFuncionarioModel extends Model
{
    protected $table = 'sfl_dias_funcionario';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'rut_funcionario',
        'id_solicitud',
        'dias',
        'observacion',
        'tipo',
        'formulario',
        'estado'
    ];
    protected $DBGroup = 'users';

    public function getDias()
    {
        $dias = $this->findAll();
        return json_encode($dias);
    }

    public function getDiasByRut($rut_funcionario)
    {
        $dias = $this->where('rut_funcionario', $rut_funcionario)->findAll();
        return json_encode($dias);
    }

    public function getDiasOcupadosFl($rut)
    {
        $encrypter= service('encrypter');
        
        $query = $this->selectSum('dias', 'dias_ocupados')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('tipo', "FERIADO LEGAL")
            ->where('estado', "ocupados")
            ->get()
            ->getRowArray();

        return $query ['dias_ocupados'] ?? 0;
    }
    public function getDiasOcupadosAd($rut)
    {
        $encrypter= service('encrypter'); 

        $query = $this->selectSum('dias', 'dias_ocupados')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('tipo', "ADMINISTRATIVO")
            ->where('estado', "ocupados")
            ->get()
            ->getRowArray();

        return $query['dias_ocupados'] ?? 0;
    }
    public function getDiasAdicionalesFl($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias', 'dias_ocupados')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('tipo', "FERIADO LEGAL")
            ->where('estado', "adicionales")
            ->get()
            ->getRowArray();

        return $query['dias_adicionales'] ?? 0;
    }
    public function getDiasAdicionalesAd($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias', 'dias_adicionales')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('tipo', "ADMINISTRATIVO")
            ->where('estado', "adicionales")
            ->get()
            ->getRowArray();

        return $query['dias_adicionales'] ?? 0;
    }
    public function getDiasF40201($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias','dias')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('formulario', "PERMISO CON GOCE DE REMUNERACIONES")
            ->get()
            ->getRowArray();

        return $query['dias'] ?? 0;
    }
    public function getDiasF40202($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias','dias')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('formulario', "PERMISO SIN GOCE DE REMUNERACIONES")
            ->get()
            ->getRowArray();

        return $query['dias'] ?? 0;
    }
    public function getDiasF40203($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias','dias')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('formulario', "PERMISO POSTNATAL PARENTAL")
            ->get()
            ->getRowArray();

        return $query['dias'] ?? 0;
    }
    public function getDiasF40204($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias','dias')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('formulario', "PERMISO GREMIAL")
            ->get()
            ->getRowArray();

        return $query['dias'] ?? 0;
    }
    public function getDiasF40205($rut)
    {
        $encrypter= service('encrypter');

        $query = $this->selectSum('dias','dias')
            ->where('rut_funcionario', $encrypter->decrypt($rut))
            ->where('formulario', "DESCANSO COMPLEMENTARIO")
            ->get()
            ->getRowArray();

        return $query['dias'] ?? 0;
    }
}
