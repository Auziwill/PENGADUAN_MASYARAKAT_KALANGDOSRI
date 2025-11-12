<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan'; // Disesuaikan menjadi 'pengaduan'
    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'id_user',
        'judul',
        'id_kategori',
        'isi',
        'lokasi',
        'foto',
        'status',
        'tanggal_pengaduan'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_pengaduan' => 'datetime', // Dipastikan ada dan disesuaikan dengan 'tanggal_pengaduan'
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user'); // id_user sudah benar sebagai foreign key
    }

    // Relasi ke model Tanggapan
    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan'); // id_pengaduan sudah benar sebagai foreign key
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

}
