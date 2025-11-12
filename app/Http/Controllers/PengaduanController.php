<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kategori;
use App\Models\Pengaduan;
use App\Exports\UserExport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;





class PengaduanController extends Controller

{
    // method lain seperti index(), store(), dll
       public function index()
    {
        $kategori = Kategori::all();
        $pengaduan = Pengaduan::where('id_user', Auth::id())
                                ->with(['tanggapan.admin', 'user'])
                                ->with(['kategori', 'user'])
                                ->latest()
                                ->get();
        return view('pengaduan', compact('pengaduan', 'kategori'));
    }

      public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:150',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'isi' => 'required|string',
            'lokasi' => 'nullable|string|max:255',
            'foto' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $newFileName = 'fotopengaduan_' . time() . '.' . $extension;
            $path = $file->storeAs('pengaduan_foto', $newFileName, 'public');
        }

        Pengaduan::create([
            'id_user' => Auth::id(),
            'judul' => $request->judul,
             'id_kategori' => $request->id_kategori,
            'isi' => $request->isi,
            'lokasi' => $request->lokasi,
            'foto' => $path,
            'status' => 'menunggu',
            'tanggal_pengaduan' => Carbon::now()
        ]);

        return redirect()->route('pengaduan')->with('success', 'Pengaduan berhasil dikirim.');
    }

        public function statistik()
    {
        $totalPengaduan = Pengaduan::count();
        $pengaduanSelesai = Pengaduan::where('status', 'selesai')->count();
        $pengaduanDiproses = Pengaduan::where('status', 'diproses')->count();
        
        $penggunaAktif = \App\Models\User::count();
        $totalKategori = Kategori::count();

         $pengaduanPerKategori = Pengaduan::select('id_kategori', DB::raw('count(*) as total'))
            ->groupBy('id_kategori')
            ->with('kategori')
            ->get();
        
        $kategoriLabels = [];
        $kategoriData = [];
        
        foreach ($pengaduanPerKategori as $item) {
            $kategoriLabels[] = $item->kategori->nama_kategori ?? 'Tidak Ada Kategori';
            $kategoriData[] = $item->total;
        }

        $statusData = [
        'menunggu' => Pengaduan::where('status', 'Menunggu')->count(),
        'proses' => Pengaduan::where('status', 'Proses')->count(),
        'selesai' => Pengaduan::where('status', 'Selesai')->count(),
    ];

              // Data untuk chart tren (6 bulan terakhir)
        $trendData = Pengaduan::select(
                DB::raw('MONTH(created_at) as bulan'),
                DB::raw('YEAR(created_at) as tahun'),
                DB::raw('count(*) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'asc')
            ->orderBy('bulan', 'asc')
            ->get();
        
        $trendLabels = [];
        $trendCounts = [];
        
        $bulanIndonesia = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];
        
        foreach ($trendData as $trend) {
            $trendLabels[] = $bulanIndonesia[$trend->bulan] . ' ' . $trend->tahun;
            $trendCounts[] = $trend->total;
        }

        return view('welcome', compact(
            'totalPengaduan',
            'pengaduanSelesai',
            'totalKategori',
            'kategoriLabels',
            'kategoriData',
            'trendLabels',
            'statusData',
            'trendCounts',
            'pengaduanDiproses',
            'penggunaAktif'
        ));
    }

    public function exportExcel()
    {
        
        $filename = now()->format('d-m-Y_H.i.s');
             return Excel::download(new UserExport,'DataUser_'.$filename.'.xlsx');
    }
}


