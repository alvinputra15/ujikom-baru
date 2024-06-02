<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table      = 'tingkats';
    protected $primaryKey      = 'kode_tingkat';
    protected $keyType     = 'string';
    public $incrementing = false;
    protected $fillable     = [
        'kode_tingkat',
        'tingkat'
    ];
}
