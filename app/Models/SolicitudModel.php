<?php namespace App\Models;

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


}
