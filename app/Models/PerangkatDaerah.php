<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'alamat',
        'telepon',
        'logo',
        'api_token',
    ];

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
