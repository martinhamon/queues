<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use App\Models\Patient;
use App\Models\patient_queue;

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
       

        Log::info('Call method invoked with parameter: ' ,['p'=> $patient]);
        $this->dispatch('callAdded', $patient);
    }

    #[On('callAdded')]
    public function showCaller($parameter = null)
    {

        
        if (!empty($parameter)) {
            // Obtener el paciente actual
            $patient = Patient::find($parameter['patient']['id']);
        } else {
            $patient = null;
        }

        // Obtener los últimos 4 llamados
        $this->recentCalls = patient_queue::where('status', 'in progress')
            ->orderBy('created_at', 'desc') // Ordenar por 'created_at' en orden descendente
            ->take(4)
            ->get();
          
        if ($parameter===null) {
          //  $patient = Patient::find($this->recentCalls->first()->patient_id);
            $patient = new Patient();
         
        } else {

            $this->patient = $patient;
           

                $this->medicalOffice = $parameter['office']['id'];
           
            }
        
    }




    #[On('echo:patient-call,MessageEvent')]
    public function eventProccess($parameter = null)
    {
        dd($parameter);
        Log::info('Llego a showCallereee ' . $parameter['patient']['name']);
        if (!empty($parameter)) {
            // Obtener el paciente actual
            $patient = Patient::where('dni',$parameter['patient']['id']);
        } else {
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
