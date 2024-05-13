<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    use HasFactory;
    protected $table      = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $fillable   = ['user_id', 'petugas_id', 'bulan','kelas',
    'nominal', 'status_bayar'];
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
}
