<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table      = 'pembayarans';
    protected $primaryKey      = 'kode_pembayaran';
    protected $keyType     = 'string';
    public $incrementing = false;
    protected $fillable     = [
        'kode_pembayaran',
        'metode'
    ];
}
