<?php

namespace App\Policies;

use Awcodes\Curator\Models\Media; // Pastikan ada titik koma di sini
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MediaPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function view(User $user, Media $media): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function create(User $user): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function update(User $user, Media $media): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function delete(User $user, Media $media): bool
    {
        return $user->perangkat_daerah_id === null;
    }
}
