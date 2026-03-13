<?php

namespace App\Policies;

use App\Models\User; // Pastikan ada titik koma di sini
use Awcodes\Curator\Models\Media;

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
