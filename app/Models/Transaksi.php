<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;
    protected $table      = 'transaksi';
    protected $primaryKey = 'kode_transaksi';
    protected $keyType     = 'string';
    public $incrementing = false;
    protected $fillable   = ['kode_transaksi','user_id', 'tanggal_transaksi', 'ajaran_kode', 'metode_kode', 
    'bulan','kelas_id', 'nominal', 'status_bayar'];
    public static function total()
    {
        // Menggunakan metode all() untuk mengambil semua transaksi
        $transaksis = static::all();
        
        // Variabel untuk menyimpan total nominal
        $total = 0;

        // Iterasi melalui semua transaksi dan tambahkan nilai nominal ke total
        foreach ($transaksis as $transaksi) {
            $total += $transaksi->nominal;
        }

        return $total;
    }

    public function User(): BelongsTo{return $this->belongsTo(User::class, 'user_id', 'id');}
    public function Kelas(): BelongsTo{return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');}

    public function Metode(): BelongsTo{return $this->belongsTo(Metode::class, 'metode_kode', 'kode_metode');}
    public function Ajaran(): BelongsTo{return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran');}
}
