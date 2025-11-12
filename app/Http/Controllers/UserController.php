<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class UserController extends Controller
{
    use ThrottlesLogins;

    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Periksa apakah ada terlalu banyak percobaan login yang gagal
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            // Lempar exception yang akan memberikan pesan error otomatis
            return $this->sendLockoutResponse($request);
        }

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Jika login berhasil, hapus counter percobaan login yang gagal
            $this->clearLoginAttempts($request);
            
            Auth::login($user);

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login admin berhasil.');
            } else {
                return redirect()->route('pengaduan')->with('success', 'Login berhasil.');
            }
        }
        
        // Jika login gagal, tambahkan counter percobaan login
        $this->incrementLoginAttempts($request);
        return back()->with('error', 'Email atau password salah.');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Proses registrasi
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[_@$!%*#?&]/',
            ],
        ], [
            'password.regex' => 'Kata sandi harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu karakter khusus (_@$!%*#?&).'
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'masyarakat',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Menampilkan form ubah password
    public function showChangePasswordForm()
    {
        return view('user.change_password');
    }

    // Proses ubah password
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Kata sandi saat ini salah.');
                }
            }],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[_@$!%*#?&]/',
            ],
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi baru minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
            'new_password.different' => 'Kata sandi baru tidak boleh sama dengan kata sandi saat ini.',
            'new_password.regex' => 'Kata sandi baru harus mengandung setidaknya satu huruf kecil, satu huruf besar, satu angka, dan satu karakter khusus (_@$!%*#?&).'
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi Anda berhasil diubah.');
    }

    /**
     * Tentukan username field yang digunakan untuk throttling.
     * Dalam kasus ini adalah 'email'.
     */
    protected function username()
    {
        return 'email';
    }
}
