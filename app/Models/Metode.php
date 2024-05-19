<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Metode extends Model
{
    use HasFactory;
    protected $table      = 'metode';
    protected $primaryKey = 'kode_metode';
    protected $keyType     = 'string';
    public $incrementing = false;
    protected $fillable   = ['kode_metode', 'metode_pembayaran'];
    public function Transaksi(): HasMany{
        return $this->hasMany(Transaksi::class, 'metode_kode', 'kode_metode');
     }
}
