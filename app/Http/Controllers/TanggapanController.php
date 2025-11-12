<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanggapan;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'id_admin' => 'required|exists:users,id_user',
            'isi_tanggapan' => 'required',
        ]);

        $tanggapan = Tanggapan::create($request->all());
        return response()->json($tanggapan, 201);
    }

    public function index()
    {
        return response()->json(Tanggapan::with(['pengaduan', 'admin'])->get());
    }
    
}
