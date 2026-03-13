<?php

namespace App\Policies;

use App\Models\User;
use Croustibat\FilamentJobsMonitor\Models\QueueMonitor; // Perbaikan: Namespace vendor yang benar

class JobMonitorPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function view(User $user, QueueMonitor $queueMonitor): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, QueueMonitor $queueMonitor): bool
    {
        return false;
    }

    public function delete(User $user, QueueMonitor $queueMonitor): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function restore(User $user, QueueMonitor $queueMonitor): bool
    {
        return false;
    }

    public function forceDelete(User $user, QueueMonitor $queueMonitor): bool
    {
        return false;
    }
}
