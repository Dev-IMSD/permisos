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

     //Envia toda la informacion 
     public function getSolicitudById($id_solicitud)
     {
          // se reliza la consulta con Join 
          $solicitud = $this->select('sfl_solicitud.id as id_solicitud,sfl_solicitud.*,sistemas_users.*')
               ->join('sistemas_users', 'sistemas_users.rut = sfl_solicitud.rut_solicitante')
               ->where('sfl_solicitud.id', $id_solicitud)
               ->first();

          return $solicitud;
     }

     //solo envia la informacion de la solicitud
     public function getSolicitudById2($id_solicitud)
     {
          // se reliza la consulta con Join 
          $solicitud = $this->select('sfl_solicitud.id as id_solicitud,sfl_solicitud.*')
               ->join('sistemas_users', 'sistemas_users.rut = sfl_solicitud.rut_solicitante')
               ->where('sfl_solicitud.id', $id_solicitud)
               ->first();

          return $solicitud;
     }

     public function solicitar($rut, $estado)
     {
          $encrypter = service('encrypter');

          $hoy = date('Y-m-d');
          $request = service('request');
          $rut_subrogante = $request->getPost('rut_subrogante');

          if ($estado != '') {
               $estado = "En correción";
          } elseif ($rut_subrogante == "") {
               $estado = "Pendiente de aprobación";
          } else {
               $estado = "Pendiente Firma Subrogancia";
          }

          $motivo = null;
          if ($request->getPost('tipo_solicitud') == "PERMISO CON GOCE DE REMUNERACIONES") {
               $motivo = $request->getPost('motivo_1');
          }
          if ($request->getPost('tipo_solicitud') == "PERMISO SIN GOCE DE REMUNERACIONES") {
               $motivo = $request->getPost('motivo_2');
          }
          if ($request->getPost('tipo_solicitud') == "DESCANSO COMPLEMENTARIO") {
               $motivo = $request->getPost('motivo_3');
          }
          if ($motivo == "OTRO") {
               $motivo = $request->getPost('motivo_otro');
          }

          $field = array(
               'fecha'             => $hoy,
               'rut_solicitante'   => $encrypter->decrypt($rut),
               'fecha_inicio'      => $request->getPost('desde'),
               'fecha_termino'     => $request->getPost('hasta'),
               'dias'              => $request->getPost('diasPedidos'),
               'estado'            => $estado,
               'tipo_solicitud'    => $request->getPost('tipo_solicitud'),
               'meses_pedidos'     => $request->getPost('meses_pedidos'),
               'semanas_pedidas'   => $request->getPost('semanas_pedidas'),
               'medio_dia'         => $request->getPost('medio_dia'),
               'beneficiario'      => $request->getPost('beneficiario'),
               'reintegro'         => $request->getPost('reintegro'),
               'tiempo'            => $request->getPost('tiempo'),
               'hora_desde'        => $request->getPost('hora_desde'),
               'hora_hasta'        => $request->getPost('hora_hasta'),
               'horas'             => $request->getPost('horas'),
               'minutos'           => $request->getPost('minutos'),
               'desde_alcalde'     => $request->getPost('desde_alcalde'),
               'hasta_alcalde'     => $request->getPost('hasta_alcalde'),
               'accion_alcalde'    => $request->getPost('accion_alcalde'),
               'year'              => $request->getPost('year_alcalde'),
               'motivo'            => $motivo,
               'rut_subrogante'    => $rut_subrogante,

          );
          // $this->db->where('id',$id);

          try {
               if ($this->insert($field)) {
                    return true;
               } else {
                    return false;
               }
          } catch (\Exception $e) {
               log_message('error', $e->getMessage());
               return false;
          }
     }


     public function actualizarSolicitud($id_solicitud)
     {
          $hoy = date('Y-m-d');
          $request = service('request');
          $rut_subrogante = $request->getPost('rut_subrogante');

          if ($rut_subrogante == "") {
               $estado = "Pendiente de aprobación";
          } else {
               $estado = "Pendiente Firma Subrogancia";
          }


          if (!$id_solicitud || !$request->getPost('desde') || !$request->getPost('hasta')) {
               return false;
          }

          $motivo = null;
          if ($request->getPost('tipo_solicitud') == "PERMISO CON GOCE DE REMUNERACIONES") {
               $motivo = $request->getPost('motivo_1');
          }
          if ($request->getPost('tipo_solicitud') == "PERMISO SIN GOCE DE REMUNERACIONES") {
               $motivo = $request->getPost('motivo_2');
          }
          if ($request->getPost('tipo_solicitud') == "DESCANSO COMPLEMENTARIO") {
               $motivo = $request->getPost('motivo_3');
          }
          if ($motivo == "OTRO") {
               $motivo = $request->getPost('motivo_otro');
          }

          $field = array(
               'tipo_solicitud'    => $request->getPost('tipo_solicitud'),
               'fecha'             => $hoy,
               'fecha_inicio'      => $request->getPost('desde'),
               'fecha_termino'     => $request->getPost('hasta'),
               'dias'              => $request->getPost('diasPedidos'),
               'estado'            => $estado,
               'meses_pedidos'     => $request->getPost('meses_pedidos'),
               'semanas_pedidas'   => $request->getPost('semanas_pedidas'),
               'medio_dia'         => $request->getPost('medio_dia'),
               'beneficiario'      => $request->getPost('beneficiario'),
               'reintegro'         => $request->getPost('reintegro'),
               'tiempo'            => $request->getPost('tiempo'),
               'hora_desde'        => $request->getPost('hora_desde'),
               'hora_hasta'        => $request->getPost('hora_hasta'),
               'horas'             => $request->getPost('horas'),
               'minutos'           => $request->getPost('minutos'),
               'desde_alcalde'     => $request->getPost('desde_alcalde'),
               'hasta_alcalde'     => $request->getPost('hasta_alcalde'),
               'accion_alcalde'    => $request->getPost('accion_alcalde'),
               'year'              => $request->getPost('year_alcalde'),
               'motivo'            => $motivo,
               'rut_subrogante'    => $rut_subrogante,

          );

          if ($this->where('id', $id_solicitud)->set($field)->update()) {
               return true;
          } else {

               return false;
          }
     }





     public function solicitudes()
     {    // se envia la informacion, con findAll para que envie una lista
          $solicitud = $this->select('sfl_solicitud.id as id_solicitud, sfl_solicitud.*, sistemas_users.*')
               ->join('sistemas_users', 'sistemas_users.rut = sfl_solicitud.rut_solicitante')
               ->findAll();

          return $solicitud;
     }
}
