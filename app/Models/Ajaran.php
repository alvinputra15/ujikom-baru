<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ajaran extends Model
{
    use HasFactory;
    protected $table      = 'ajarans';
    protected $primaryKey      = 'kode_ajaran';
    protected $keyType     = 'string';
    public $incrementing = false;
    protected $fillable     = [
        'kode_ajaran',
        'tahun_ajaran'
    ];
    public function Transaksi(): HasMany{
        return $this->hasMany(Transaksi::class, 'ajaran_kode', 'kode_ajaran');
     }
}
