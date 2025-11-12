<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
    {
        use SendsPasswordResetEmails;

        public function __construct()
        {
            $this->middleware('guest');
        }

        public function showLinkRequestForm()
        {
            // Log::info('Halaman lupa kata sandi diakses.'); // Tambahkan/pastikan baris ini ada
            return view('auth.email');
        }
    }
    