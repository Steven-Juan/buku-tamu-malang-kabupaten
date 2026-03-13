<?php

namespace App\Policies;

use App\Models\User;
use BezhanSalleh\FilamentExceptions\Models\Exception; // Perbaikan: Namespace vendor yang benar

class ExceptionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function view(User $user, Exception $exception): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Exception $exception): bool
    {
        return false;
    }

    public function delete(User $user, Exception $exception): bool
    {
        return $user->perangkat_daerah_id === null;
    }

    public function restore(User $user, Exception $exception): bool
    {
        return false;
    }

    public function forceDelete(User $user, Exception $exception): bool
    {
        return false;
    }
}
