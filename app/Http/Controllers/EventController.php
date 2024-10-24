<?php

namespace App\Http\Controllers;

use App\Models\office;
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
            $patient->name = $request->patient['name'];
            $patient->lastname = $request->patient['last_name'];
            $patient->dni = $request->patient['pat_dni'];
           
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
       

       return response()->json(['status' => 'Evento procesado correctamente']);
    }


    public function callPatient(Request $request)
    {  
        $patient = Patient::find($request->patient);
       
        $query   = patient_queue::where('patient_id',$request->patient)
        ->Where('office_id', $request->office);
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        $fullSql = vsprintf(str_replace('?', '%s', $sql), array_map(function ($binding) {
            return is_numeric($binding) ? $binding : "'$binding'";
        }, $bindings));

        $patientQueue = $query->first();
       
                $patientQueue->status = 'in progress';
         $patientQueue->save();
        
        event(new \App\Events\PatientCall($patient,office::find($request->office)));   
        return response()->json(['status' =>  $query]); 
    }

    public function getQueue()
    {
        $patients_in_queue = patient_queue::where('status','!=', 'completed')
        ->join('patients', 'patients.id', '=', 'patient_queues.patient_id')
        ->join('offices', 'offices.id', '=', 'patient_queues.office_id')
        ->orderBy('patient_queues.created_at', 'asc')->get();
        return response()->json($patients_in_queue);
    }


    public function test(){
        return response()->json(['status' => 'Evento procesado correctamente']);
    }
}
