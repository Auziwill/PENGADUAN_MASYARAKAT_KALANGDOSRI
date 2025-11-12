<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword; // Add this
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword // Implement the interface
{
    use HasFactory, Notifiable;
    use \Illuminate\Auth\Passwords\CanResetPassword; // Add this trait

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_user');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_admin');
    }
}