<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudModel extends Model
{
    protected $table = 'sfl_solicitud';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'fecha',
        'rut_solicitante',
        'dias',
        'fecha_inicio',
        'fecha_termino',
        'estado',
        'observacion',
        'rut_firma',
        'tipo_solicitud',
        'motivo',
        'meses_pedidos',
        'semanas_pedidas',
        'medio_dia',
        'beneficiario',
        'reintegro',
        'tiempo',
        'hora_desde',
        'hora_hasta',
        'horas',
        'minutos',
        'desde_alcalde',
        'hasta_alcalde',
        'accion_alcalde',
        'year',
        'rut_subrogante',
        'firma_subrogante',
        'firma_rrhh',
        'nombre_rrhh'
    ];
    protected $DBGroup = 'users';

    public function getSolictudesJson()
    {
        try {
            $solicitudes = $this->findAll();
            return json_encode($solicitudes);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    
    public function getSolicitudById($id_solicitud)
    {
        // se reliza la consulta con Join 
        return $this->select('sfl_solicitud.id as id_solicitud,sfl_solicitud.*,sistemas_users.*')
            ->join('sistemas_users', 'sistemas_users.rut = sfl_solicitud.rut_solicitante')
            ->where('sfl_solicitud.id', $id_solicitud)
            ->find();

    }
}


