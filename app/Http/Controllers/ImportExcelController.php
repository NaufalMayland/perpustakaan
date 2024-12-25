<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportExcelController extends Controller
{
    public function importUser()
    {
        return view('petugas.user.importUser', [
            'title' => "Import"
        ]);
    }

    public function templateUser()
    {
        $templatePath = storage_path('app/public/templateExcel/UserTemplate.xlsx');

        if (!file_exists($templatePath)) {
            abort(404, 'File template tidak ditemukan.');
        }

        $fileName = 'UserTemplate.xlsx';
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return response()->download($templatePath, $fileName, $headers);
    }

    public function importUserAction()
    {
        
    }
}
