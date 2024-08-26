<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\Log; // Add this line to import the Log class
use Livewire\Attributes\On;
use App\Models\Patient; // Add this line to import the Patient class
use App\Models\patient_queue; // Add this line to import the patient_queue class

class MainQueue extends Component
{

    public $patient;
    public $medicalOffice;
    public $recentCalls;
    public $audio_path;

    public function render()
    {
        return view('livewire.main-queue')->layout('layouts.app');
    }

    public function mount()
    {
        $this->dispatch('callAdded');
    }

    public function callPatient($patient)
    {  
        
        Log::info('Call method invoked with parameter: ' .$patient['patient']['name']);
        $this->dispatch('callAdded', $patient);
    }

    #[On('callAdded')]
    public function showCaller($parameter=null)
    {
        
       
        if(!empty($parameter)){
        // Obtener el paciente actual
        $patient = Patient::find($parameter['patient']['id']); 
        }else{
            $patient = Patient::first();
        }

        // Obtener los últimos 4 llamados
        $this->recentCalls = patient_queue::latest()->take(4)->get();

        // Datos del paciente actual
        $this->patient = $patient;
        $this->medicalOffice = 'Consultorio xx'; 

     
    }


    

    #[On('echo:patient-call,MessageEvent')]
    public function eventProccess($parameter=null)
    {
        
        Log::info('Llego a showCallereee ' .$parameter['patient']['name']);
        if(!empty($parameter)){
        // Obtener el paciente actual
        $patient = Patient::find($parameter['patient']['id']); 
        }else{
            $patient = Patient::first();
        }

        // Obtener los últimos 4 llamados
        $this->recentCalls = patient_queue::latest()->take(4)->get();

        // Datos del paciente actual
        $this->patient = $patient;
        $this->medicalOffice = 'Consultorio xx'; 
        Log::info('Llego a showCallereee ' . $parameter['patient']['name']);
    }
  
}
