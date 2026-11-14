<?php

use App\Livewire\DepartmentDetail;
use App\Livewire\Guest\Show as GuestShow;
use App\Livewire\GuestForm;
use App\Livewire\Home;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
// Detail kunjungan berisi data pribadi tamu: hanya untuk admin yang login
Route::get('/article/{guest}', GuestShow::class)->middleware('auth')->name('guest.show');
Route::get('/instansi/{slug}', DepartmentDetail::class)->name('department.detail');
Route::get('/kunjungan/{slug}', GuestForm::class)->name('guest.form');
