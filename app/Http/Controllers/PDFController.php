<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class PDFController extends Controller
{
    public function downloadPDF()
    {
        $data = [
            'title' => 'Test Download PDF',
            'content' => 'Ini adalah contoh file PDF yang dihasilkan oleh Laravel menggunakan DomPDF.'
        ];

        $pdf = PDF::loadView('pdf.template', $data);
        return $pdf->download('test_download.pdf');
    }
}
