<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;


    protected $table = 'tanggapan';

    // Mendefinisikan primary key jika bukan 'id' (dalam kasus ini 'id_tanggapan')
    protected $primaryKey = 'id_tanggapan';

    protected $fillable = [
        'id_pengaduan',
        'id_admin',
        'isi_tanggapan',
        'tanggal_tanggapan'
    ];

    /**
     * Atribut yang harus di-cast ke tipe data native.
     * 'tanggal_tanggapan' akan secara otomatis diubah menjadi objek Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

   
    public function pengaduan()
    {
        // 'id_pengaduan' adalah foreign key di tabel 'tanggapan'
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan');
    }


    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin', 'id_user');
    }
}