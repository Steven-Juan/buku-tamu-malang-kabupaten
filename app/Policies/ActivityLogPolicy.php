<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ActivityLogPolicy
{
    /**
     * Hanya izinkan Super Admin (perangkat_daerah_id null) untuk melihat daftar log.
     */
    public function viewAny(User $user): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    /**
     * Hanya izinkan Super Admin untuk melihat detail log.
     */
    public function view(User $user, Activity $activity): bool
    {
        return $user->perangkat_daerah_id === null;
    }
}
