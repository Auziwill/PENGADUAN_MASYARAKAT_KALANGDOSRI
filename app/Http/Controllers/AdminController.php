<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PengaduanExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();
        $users = User::all();
        $tanggapans = Tanggapan::with(['pengaduan', 'admin'])->latest()->get();

        $passwordResets = DB::table('password_reset_tokens')
                            ->latest('created_at')
                            ->get()
                            ->map(function ($item) {
                                $item->created_at = Carbon::parse($item->created_at);
                                return $item;
                            });

        return view('admin.dashboard', compact('pengaduans', 'users', 'tanggapans', 'passwordResets'));
    }

    public function show($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('admin.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data pengaduan berhasil dihapus.');
    }

    // --- User Management Methods ---

    public function usersIndex()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function usersCreate()
    {
        return view('admin.users.create');
    }

    public function usersStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,masyarakat',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function usersEdit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function usersUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'role' => 'required|in:admin,masyarakat',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function usersDestroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Pengguna berhasil dihapus.');
    }

    // --- Tanggapan Management Methods ---

    public function tanggapansIndex()
    {
        $tanggapans = Tanggapan::with(['pengaduan', 'admin'])->latest()->get();
        return view('admin.tanggapans.index', compact('tanggapans'));
    }

    public function tanggapansCreate()
    {
        $pengaduans = Pengaduan::with('user')->get(); // Penting: load user relasi
        $admins = User::where('role', 'admin')->get();
        return view('admin.tanggapans.create', compact('pengaduans', 'admins'));
    }

    public function tanggapansStore(Request $request)
    {
        $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'id_admin' => 'required|exists:users,id_user',
            'isi_tanggapan' => 'required|string',
        ]);

        // Baris ini yang sebelumnya error
        Tanggapan::create([
            'id_pengaduan' => $request->id_pengaduan,
            'id_admin' => $request->id_admin,
            'kategori_pengaduan' => $request->kategori_pengaduan,
            'isi_tanggapan' => $request->isi_tanggapan,
            'tanggal_tanggapan' => Carbon::now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Tanggapan berhasil ditambahkan.');
    }

    public function tanggapansEdit($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $pengaduans = Pengaduan::all();
        $admins = User::where('role', 'admin')->get();
        return view('admin.tanggapans.edit', compact('tanggapan', 'pengaduans', 'admins'));
    }

    public function tanggapansUpdate(Request $request, $id)
    {
        $tanggapan = Tanggapan::findOrFail($id);

        $request->validate([
            'id_pengaduan' => 'required|exists:pengaduan,id_pengaduan',
            'id_admin' => 'required|exists:users,id_user',
            'isi_tanggapan' => 'required|string',
        ]);

        $tanggapan->id_pengaduan = $request->id_pengaduan;
        $tanggapan->id_admin = $request->id_admin;
        $tanggapan->isi_tanggapan = $request->isi_tanggapan;
        $tanggapan->save();

        return redirect()->route('admin.dashboard')->with('success', 'Tanggapan berhasil diperbarui.');
    }

    public function tanggapansDestroy($id)
    {
        $tanggapan = Tanggapan::findOrFail($id);
        $tanggapan->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Tanggapan berhasil dihapus.');
    }

    // --- Password Reset Token Management Methods ---
    public function passwordResetsIndex()
    {
        $passwordResets = DB::table('password_reset_tokens')
                            ->latest('created_at')
                            ->get()
                            ->map(function ($item) {
                                $item->created_at = Carbon::parse($item->created_at);
                                return $item;
                            });
        return view('admin.password_resets.index', compact('passwordResets'));
    }

    public function passwordResetsDestroy($email)
    {
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Token reset password berhasil dihapus.');
    }

     public function exportPdfPengaduan()
    {
        $pengaduans = Pengaduan::with('user')->latest()->get();
        $pdf = Pdf::loadView('admin.pengaduan_pdf', compact('pengaduans'));
        return $pdf->download('laporan-pengaduan-' . Carbon::now()->format('Ymd_His') . '.pdf');
    }

}