<?php

namespace App\Livewire;

use App\Models\office;
use Livewire\Component;
use App\Models\Patient;
use App\Models\patient_queue;
class Caller extends Component
{
    public $patients; 
    

    public function mount()
    {
        $this->patients = patient_queue::join('patients', 'patient_queues.patient_id', '=', 'patients.id')
        ->select('patient_queues.*', 'patients.name', 'patients.lastname', 'patients.dni')
        ->where('status', 'waiting')
        ->orWhere('status', 'in progress')
        ->get();
    }

    public function render()
    { 
        $this->mount();
        return view('livewire.caller')->layout('layouts.app');;
    }


    
    public function callPatient($patient,$office)
    {
        $query   = patient_queue::where('patient_id', $patient)
       ->Where('office_id', $office);
       
       $patientQueue = $query->first();
      
               $patientQueue->status = 'in progress';
        $patientQueue->save();
      
     
        event(new \App\Events\PatientCall(Patient::find($patient),office::find ($office))); 
    }

    public function finalize($id)
    {
        $patient = patient_queue::find($id);
        $patient->status = 'completed';
        $patient->save();
        $this->mount();
    }
}
