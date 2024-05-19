<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table      = 'kelas';
    protected $primaryKey = 'id_kelas';
    protected $fillable   = ['kelas', 'status'];

    public function Transaksi(): HasMany{
        return $this->hasMany(Transaksi::class, 'kelas_id', 'id_kelas');
     }
}
