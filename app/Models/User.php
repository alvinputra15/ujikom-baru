<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nis',
        'name',
        'email',
        'alamat',
        'telepon',
        'ajaran_kode',
        'kelas_kode',
        'tingkat_kode',
        'level',
        'foto_profile',
        'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function getLevel()
    {
        return [
            'admin'     => 'Admin',
            'petugas'   => 'Petugas',
            'user'      => 'User'
        ];
    }

    public function Transaksi(): HasMany{
        return $this->hasMany(Transaksi::class, 'user_id', 'id');}
        public function Kelas(): BelongsTo{return $this->belongsTo(Kelas::class, 'kelas_id', 'id_kelas');}

        public function Tingkat(): BelongsTo{return $this->belongsTo(Tingkat::class, 'tingkat_kode', 'kode_tingkat');}
        public function Ajaran(): BelongsTo{return $this->belongsTo(Ajaran::class, 'ajaran_kode', 'kode_ajaran');}

}
