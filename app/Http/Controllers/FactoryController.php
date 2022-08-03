<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PDFFactory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    public function pdfUsers(Request $request)
    {
        $pdf = PDFFactory::make($request);

        $pdf->loadView('admin.pdf.users', [
            'users' => User::get(),
        ]);

        return $pdf->download('users_report.pdf');
    }
}