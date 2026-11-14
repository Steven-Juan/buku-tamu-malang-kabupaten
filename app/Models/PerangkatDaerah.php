<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PerangkatDaerah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_pd',
        'slug',
        'email',
        'alamat',
        'telepon',
        'id_survey',
        'logo',
    ];

    /**
     * api_key berisi hash SHA-256, bukan kunci aslinya. Diisi hanya lewat regenerateApiKey().
     *
     * @var list<string>
     */
    protected $hidden = [
        'api_key',
    ];

    public static function hashApiKey(string $plainKey): string
    {
        return hash('sha256', $plainKey);
    }

    /**
     * Buat API key baru, simpan hash-nya, dan kembalikan kunci asli (hanya bisa dilihat sekali).
     */
    public function regenerateApiKey(): string
    {
        $plainKey = 'pd_'.Str::random(40);

        $this->forceFill(['api_key' => static::hashApiKey($plainKey)])->save();

        return $plainKey;
    }

    public function apiKeyMatches(string $plainKey): bool
    {
        return is_string($this->api_key)
            && hash_equals($this->api_key, static::hashApiKey($plainKey));
    }

    /**
     * Get the users/admins for the office.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the guest records for the office.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
