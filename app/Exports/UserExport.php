<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserExport implements FromView
{
    public function view(): View
    {
        return view('admin/users/excel', [
            'pengaduan' => Pengaduan::all()
        ]);
    }
}