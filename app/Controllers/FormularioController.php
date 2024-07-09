<?php

namespace App\Controllers;

use App\Controllers\view;
use App\Models\DiasFuncionarioModel;
use App\Models\LoginModel;
use App\Models\PermisosModel;
use App\Models\SolicitudModel;
use CodeIgniter\HTTP\ResponseInterface;
use Permisos;
use ResponseTrait;


class FormularioController extends BaseController
{
    public function showSolicitud()
    {   
        try {
            $solicitudModel = new SolicitudModel();
            $solicitudJson = $solicitudModel->getSolictudesJson();
            return $this->response->setContentType('application/json')->setBody($solicitudJson);
        } catch (\Exception $e) {
            return $this->response->setContentType('application/json')->setBody(json_encode(['error' => $e->getMessage()]));
        }
    }

    //Es para mostrar la pagina 
    public function enviarInformacionSfl()
    {
        if (!$this->session->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes Permisos']);
        } else {
            return view('feriadoLegal');
        }
    }
    // Segun el la fecha de contrato calcula los dias libres
    public function obtenerDiasFl($fecha_contrato)
    {   
        //fecha actual	
        $dia = date('d');
        $mes = date('m');
        $anio = date('Y');
        //fecha de contrato
        list($year, $month, $day) = explode("-", $fecha_contrato);
        //si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual
        if (($month == $mes) && ($day > $dia)) {
            $anio = ($anio - 1);
        }
        //si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual
        if ($month > $mes) {
            $anio = ($anio - 1);
        }
        $year_worked = ($anio - $year);
        if ($year_worked < 15) {
            $diasFl = 15;
        } elseif ($year_worked >= 15 && $year_worked < 20) {
            $diasFl = 20;
        } elseif ($year_worked >= 20) {
            $diasFl = 25;
        } else {
            $diasFl = 0;
        }

        return $diasFl;
    }
    // obtiene y envia los dias diponibles del formulario
    public function formulario_F40201()
    {  
         // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');
        //obtiene los datos de la sesion
        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direccion
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);

        $diasAd = 6;
        // Obtener días ocupados desde la base de datos
        $dbDias = new DiasFuncionarioModel();
        $diasOcupadosAd = $dbDias->getDiasOcupadosAd($encryptedRut);
        $diasAdicionalesAd = $dbDias->getDiasAdicionalesAd($encryptedRut);

        $diasDisponibleAd = ($diasAd - $diasOcupadosAd) + $diasAdicionalesAd;

        $diasF40201 = $dbDias->getDiasF40201($encryptedRut);

        // Llama a la funcion para obterner los funcionarios para los subrrogantes
        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([
            'diasDisponibleAd'  => (float)$diasDisponibleAd,
            'diasF40201'        => (float)$diasF40201,
            'subrogantes'         => $subrogantes
        ]);
    }
     // obtiene y envia los dias diponibles del formulario
    public function formulario_F40202()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');
        //obtiene los datos de la sesion
        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direcion y encriptarlo
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);

        $dbDias = new DiasFuncionarioModel();
        $diasF40202 = $dbDias->getDiasF40202($encryptedRut);
        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([
            'diasF40202'        => (float)$diasF40202,
            'subrogantes'         => $subrogantes
        ]);
    }
     // obtiene y envia los dias diponibles del formulario
    public function formulario_F40203()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');

        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direcion y encriptarlo
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);

        // Obtener días ocupados desde la base de datos
        $dbDias = new DiasFuncionarioModel();
        $diasF40203 = $dbDias->getDiasF40203($encryptedRut);

        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([
            'diasF40203'        => (float)$diasF40203,
            'subrogantes'         => $subrogantes
        ]);
    }
     // obtiene y envia los dias diponibles de los formulario
    public function formulario_F40204_F40205()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');

        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direcion y encriptarlo
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);

        // Obtener días ocupados desde la base de datos
        $dbDias = new DiasFuncionarioModel();
        $diasF40204 = $dbDias->getDiasF40204($encryptedRut);
        $diasF40205 = $dbDias->getDiasF40205($encryptedRut);
        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([

            'diasF40204'        => (float)$diasF40204,
            'diasF40205'        => (float)$diasF40205,
            'subrogantes'         => $subrogantes

        ]);
    }
    // obtiene y envia los dias diponibles del formulario
     public function formulario_F40206()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');

        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direcion y encriptarlo
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);

        // Obtiene la fecha del usuario 
        $fecha_contrato = $dataSession['fecha_contrato'];
        // se obtienen los dias del trabajador segun los años 
        $diasFl = $this->obtenerDiasFl($fecha_contrato);
        // Obtener días ocupados desde la base de datos
        $dbDias = new DiasFuncionarioModel();
        $diasOcupadosFl = $dbDias->getDiasOcupadosFl($encryptedRut);
        $diasAdicionalesFl = $dbDias->getDiasAdicionalesFl($encryptedRut);

        $diasDisponibleFl = ($diasFl - $diasOcupadosFl) + $diasAdicionalesFl;

        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([
            'diasOcupadosFl'    => (float)$diasOcupadosFl,
            'diasDisponibleFl'  => (float)$diasDisponibleFl,
            'subrogantes'         => $subrogantes
        ]);
    }
     // obtiene y envia los dias diponibles del formulario
    public function formulario_F40207()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');

        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut y direcion y encriptarlo
        $encryptedRut=$encrypter->encrypt($dataSession['rut']);
        $encryptedDireccion=$encrypter->encrypt($dataSession['direccion']);


        // Obtiene la fecha del usuario 
        $subrogantesModel = new LoginModel();
        $subrogantes = $subrogantesModel->getFuncionariosDireccion($encryptedDireccion,$encryptedRut);

        return $this->response->setJSON([
            'subrogantes'         => $subrogantes
        ]);
    }
    // Enviar la informacion de la vista -> al modelo 
    public function solicitar()
    {   
        // se llama al servicio que tiene Code Igniter4 para encriptar información
        $encrypter= service('encrypter');
        $session = $this->session;
        $dataSession = $session->get();
        // Obtener rut
        $rut = $dataSession['rut'];
        $encryptedRut=$encrypter->encrypt($rut);


        $solicitud = new SolicitudModel();
        $solicitar = $solicitud->solicitar($encryptedRut, '');

        if ($solicitar) {

            return $this->response->setJSON(['message' => 'Se ha guardado con exito']);
        } else {

            return $this->response->setJSON(['message' => 'No se ha guardado']);
        }
    }

    // Enviar la informacion del modelo a la vista
    public function obtenerSfl($id_solicitud){
         $this->session;
        
        $solicitudModel = new SolicitudModel();
        $solicitud= $solicitudModel->getSolicitudById2($id_solicitud);

        
        if($solicitud){
            return $this->response->setJSON(['message' => 'Se ha guardado con exito' ,'solicitud' => $solicitud]);
        }else{
            return $this->response->setJSON(['message' => 'No se ha guardado']);
        }
    }

    // Guarda las modificaciones de la vista envia al modelo
    public function editarSolicitud($id_solicitud){
        
        $solicitudModel = new SolicitudModel();
        
        $actualizar = $solicitudModel->actualizarSolicitud($id_solicitud);

        if ($actualizar) {
            return $this->response->setJSON(['message' => 'Solicitud actualizada correctamente']);
        } else {
            return $this->response->setJSON('No se pudo actualizar la solicitud');
        }
    }

}
