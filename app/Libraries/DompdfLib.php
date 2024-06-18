<?php

namespace App\Libraries;

use Dompdf\Dompdf;

class DompdfLib
{
    protected $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }

    public function loadHtml($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation = 'portrait')
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename = 'document.pdf', $options = [])
    {
        $this->dompdf->stream($filename, $options);
    }

    public function output()
    {
        return $this->dompdf->output();
    }
}
