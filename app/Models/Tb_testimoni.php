<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tb_testimoni extends Model
{
    use HasFactory;

    public function foto()
    {
        if ($this->foto && file_exists(public_path('images/testimoni/' . $this->foto))) {
            return asset('images/testimoni/' . $this->foto);
        } else {
            return asset('images/no_image.png');
        }
    }

    public function deleteFoto()
    {
        if ($this->foto && file_exists(public_path('images/testimoni/' . $this->foto))) {
            return unlink(public_path('images/testimoni/' . $this->foto));
        }
    }
}
