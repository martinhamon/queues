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
       

        $patient = Patient::where('dni', $request->patient['pat_dni'])->first();
      // return response()->json($request->patient);

       
        
        // event(new \App\Events\PatientCall($patient)); 
       
        //Check patien table for existing patient
        if ($patient == null) {
            $patient = new Patient();
            $patient->name = $request->patient->name;
            $patient->lastname = $request->patient->last_name;
            $patient->dni = $request->patient->pat_dni;
           
            $patient->save();
        }
       foreach($request->studies as $study){
        //Equivalencia de modalidad del estudio a la office que debe figurar en pantalla.
        // CT -> 1
        // MR -> 2
        // MG -> 3
        // US -> 4
        // UNK -> 5


        switch ($study['modality']) {
            case 'CT':
                $office = 1;
                break;
            case 'MR':
                $office = 2;
                break;
            case 'MG':
                $office = 3;
                break;
            case 'US':
                $office = 4;
                break;
            default:
                $office = 5;
                break;
        };

        patient_queue::create([
            'patient_id' =>$patient->id,
            'office_id' => $office,//Change for dinamic office
           
            'priority' => 'low',
            'status' => 'waiting',
        ]);

    }
        // Aquí puedes añadir la lógica para manejar el evento
        // Por ejemplo, guardar en la base de datos, enviar una notificación, etc.

        return response()->json(['status' => 'Evento procesado correctamente']);
    }


    public function test()
    {
        return response()->json(['status' => 'Evento procesado correctamente']);
    }
}
