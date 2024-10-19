<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use App\Models\Patient;
use App\Models\patient_queue;
class EventController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Handle the incoming event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleEvent(Request $request)
    {
        // Procesar los datos recibidos
        $data = $request->all();
        
        // Log para verificar que se recibió el evento
        Log::info('Evento recibido:', $data);
        $patientQueue = patient_queue::find('1');
        $patientQueue->update(['status' => 'in progress']);
        event(new \App\Events\PatientCall(Patient::find('1'))); 
    
        // Aquí puedes añadir la lógica para manejar el evento
        // Por ejemplo, guardar en la base de datos, enviar una notificación, etc.

        return response()->json(['status' => 'Evento procesado correctamente']);
    }


    public function test(){
        return response()->json(['status' => 'Evento procesado correctamente']);
    }
}
