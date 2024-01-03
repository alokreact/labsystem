<?php
namespace App\Service;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    public function generatePdfFromView($view, $data = [])
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        //$options->setPaper('a4', 'landscape');
        $dompdf = new Dompdf($options);

        $html = view($view, compact('data'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        return $dompdf->output();
    }
}