<?php

use App\Livewire\Caller;
use App\Livewire\MainQueue;
use App\Livewire\Office;
use App\Livewire\PatientAdmission;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});






Route::get('/queue', MainQueue::class)->name('queue');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/caller', Caller::class);
    
    Route::get('/dashboard', function () {
        return view('dashboard');
       
    })->name('dashboard');

    Route::get('/patient/admission', PatientAdmission::class);
    Route::get('/admin/office', Office::class)->name('office.add');
});
