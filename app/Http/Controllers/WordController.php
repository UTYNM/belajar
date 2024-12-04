<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class WordController extends Controller
{
    public function index()
    {
        return view('content.word.create');
    }

    public function export(Request $request)
    {
        // Simpan file baru hasil modifikasi
        $fileName = 'Laporan_TL_SKM_' . '.docx';//nama template yang akan dicetak
        // Muat template Word
        $templateProcessor = new TemplateProcessor(public_path('skm/template.docx'));

        
        $templateProcessor->saveAs($fileName);
        ob_clean();
        return response()->download($fileName)->deleteFileAfterSend(true);
        exit;
    }
}