<?php

use App\Livewire\Caller;
use App\Livewire\MainQueue;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/queue', MainQueue::class);
Route::get('/caller', Caller::class);
Route::get('/patient/queue', function () {
       
    broadcast(new \App\Events\PatientCall(Patient::find(3)));
});






Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
       
    })->name('dashboard');
   
});
