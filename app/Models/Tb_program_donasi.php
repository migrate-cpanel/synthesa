<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_program_donasi extends Model
{
    use HasFactory;

    public $table = 'tb_program_donasi';

     public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tbDonasis()
{
    return $this->hasMany(Tb_donasi::class, 'id_program_donasi'); // sesuaikan foreign key-nya
}

    public function donasi()
    {
        return $this->hasMany(Tb_donasi::class, 'id_program_donasi');
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($program_donasi) {
            //mengecek apakah penulis masih punya wisata
            if ($program_donasi->donasi->count() > 0) {
                session()->put('warning', 'Data Tidak Bisa Di Hapus Karena Memiliki Donasi');
                return false;
            }
        });
    }

    public function gambar()
    {
        if ($this->gambar && file_exists(public_path('images/program-donasi/' . $this->gambar))) {
            return asset('images/program-donasi/' . $this->gambar);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteGambar()
    {
        if ($this->gambar && file_exists(public_path('images/program-donasi/' . $this->gambar))) {
            return unlink(public_path('images/program-donasi/' . $this->gambar));
        }
    }
}
