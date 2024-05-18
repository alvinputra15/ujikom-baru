<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
