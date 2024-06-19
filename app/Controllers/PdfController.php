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
        $solicitudModel = new SolicitudModel();  
        // $data = null
        $data['solicitud'] = $solicitudModel->find($id_solicitud);       
        // if (!$data['solicitud']) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Solicitud no encontrada: ' . $id_solicitud);
        // }
        $data['solicitud'] = $id_solicitud;
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true); // Habilitar URLs remotas
    
        // Instancia de Dompdf con las opciones configuradas
        $dompdf = new \Dompdf\Dompdf($options);        
        $html = view('pdf' ); 
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();               
        $pdfOutput = $dompdf->output();
                
        // return $this->response->setJSON(['status' => 'error', 'message' => 'No tienes Permisos']);
        return $this->response
                    ->setHeader('Content-Type', 'application/pdf')
                    ->setHeader('Content-Disposition', 'inline; filename="SFL N°'.$id_solicitud.'"')
                    ->setBody($pdfOutput);
    }
}
