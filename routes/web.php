<?php

use App\Livewire\Home;
use App\Livewire\Guest\Show as GuestShow;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/article/{guest:slug}', GuestShow::class)->name('guest.show');
