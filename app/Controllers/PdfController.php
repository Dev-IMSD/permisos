<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SolicitudModel;
use App\Libraries\DompdfLib;
use CodeIgniter\HTTP\ResponseInterface;

class PdfController extends BaseController
{

    public function generatePdf($id_solicitud)
    {
        if (!$this->accesoPdf($id_solicitud)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes Permisos para ver esta solicitud']);
        }

        // se llama al modelo
        $solicitudesModel = new SolicitudModel();
        // se consulta id_solicitud
        $solictud = $solicitudesModel->getSolicitudById($id_solicitud);
        // se guarda la informacion en $solicitud en $data[solicitudes]  que es un array
        $data['solicitudes'] = $solictud;
        
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $html = view('pdf', $data);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfOutput = $dompdf->output();
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="SFL N°' . $data['solicitudes'][0]['id_solicitud'] . '"')
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('X-Frame-Options', 'DENY')
            ->setHeader('X-XSS-Protection', '1; mode=block')
            ->setBody($pdfOutput);
    }

    public function accesoPdf($id_solicitud){
        //Trae los datos de la session 
        $session = $this->session;
        $dataSession = $session->get();
        $rut   = $dataSession['rut'];
        $nivel = $dataSession['nivel'];
        // Si cumple con el nivel 4 entonces regresa un TRUE
        if ($nivel == 4) {
            return true;
        }
        // Si cumple con el nivel 3 
        if ($nivel == 3) {
            $solicitudesModel = new SolicitudModel();
            $solicitud = $solicitudesModel->getSolicitudById($id_solicitud);
            //se evalua que exista solicitud, existe  y verifica si es la solicitud del solicitante entonces envia true 
            if ($solicitud && $solicitud[0]['rut_solicitante'] == $rut) {
                return true;
            }
        }
        //en caso de no cumplir con ninguna de las dos condiciones se devuelve falso a generatepdf()
        return false;
    }
}
