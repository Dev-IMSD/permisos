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
    protected $DBGroup = 'users';

    public function getSolictudesJson(){
        try {
            $solicitudes = $this->findAll();
            return json_encode($solicitudes);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function getSolicitudById($id)
    {
        try {
            $solicitud = $this->find($id);
            return json_encode($solicitud);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
      
    
    }
        // try {
        //     // Log para verificar conexión a la base de datos
        //     log_message('info', 'Intentando obtener todas las solicitudes');

        //     // Obtener todas las solicitudes
        //     $solicitudes = $this->findAll();

        //     // Log para verificar resultados
        //     log_message('info', 'Solicitudes obtenidas: ' . json_encode($solicitudes));

        //     return json_encode($solicitudes);
        // } catch (\Exception $e) {
        //     // Manejo de errores
        //     log_message('error', 'Error al obtener solicitudes: ' . $e->getMessage());
        //     return json_encode(['error' => $e->getMessage()]);
        // }
}


