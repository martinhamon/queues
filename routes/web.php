<?php

use App\Livewire\Caller;
use App\Livewire\MainQueue;
use App\Livewire\Office;
use App\Livewire\PatientAdmission;
use App\Livewire\Queueds;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;


Route::get('/', function () {
    return view('welcome');
});



Route::post('/auth/caller', function (Request $request) {
   
    try {
        $token = $request->query('token');
    $user = JWTAuth::parseToken()->authenticate();
    Auth::login($user);
      
    return redirect('http://127.0.0.1:8000/caller');
    } catch (JWTException $e) {
        // Si el token no es válido, devolver un error
        return response()->json(['error' => 'Token inválido o expirado'], 401);
    }

   
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
    Route::get('/admin/new/queue', Queueds::class)->name('queue.add');
});
