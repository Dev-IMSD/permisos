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
            return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes permisos para ver esta solicitud']);
        }

        $solicitudModel = new SolicitudModel(); 
        $solicitud = $solicitudModel->getSolicitudById($id_solicitud);

        // Asegúrate de que $solicitud sea un array con un único elemento
        $data['solicitud'] = $solicitud;

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
            ->setHeader('Content-Disposition', 'inline; filename="SFL N°' . $data['solicitud']['id_solicitud'] . '"')
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('X-Frame-Options', 'DENY')
            ->setHeader('X-XSS-Protection', '1; mode=block')
            ->setBody($pdfOutput);
    }

    // Función para verificar el acceso a la solicitud para generar el PDF
    public function accesoPdf($id_solicitud)
    {
        $session = $this->session; 
        $dataSession = $session->get(); // Obtiene los datos de la sesión

        $rut = $dataSession['rut']; 
        $nivel = $dataSession['nivel'];

        // Si el nivel de acceso es 4
        if ($nivel == 4) {
            return true; 
        }
        // Si el nivel de acceso es 3 
        if ($nivel == 3) {
            $solicitudModel = new SolicitudModel(); 
            $solicitud = $solicitudModel->getSolicitudById($id_solicitud); 
   
            if ($solicitud && $solicitud['rut_solicitante'] == $rut) {
                return true; 
            }
        }

        return false;
    }
}


