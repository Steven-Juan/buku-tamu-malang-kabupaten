<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'perangkat_daerah_id',
        'nama',
        'asal_instansi',
        'keperluan',
        'pesan_kesan',
        'foto',
        'ttd_digital',
    ];

    /**
     * Get the office (Perangkat Daerah) that the guest is visiting.
     */
    public function perangkatDaerah(): BelongsTo
    {
        return $this->belongsTo(PerangkatDaerah::class, 'perangkat_daerah_id');
    }
}
