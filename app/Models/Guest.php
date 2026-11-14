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
        'jenis_kelamin',
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

    /**
     * Tanda tangan sebagai data URI gambar base64, atau null jika isinya tidak valid
     * (mis. data lama yang dimanipulasi). Selalu pakai ini saat menampilkan tanda tangan.
     */
    public function signatureDataUri(): ?string
    {
        $value = $this->ttd_digital;

        if (! is_string($value) || ! preg_match('/^data:image\/(png|jpeg|webp);base64,[A-Za-z0-9+\/=]+$/', $value)) {
            return null;
        }

        return $value;
    }
}
