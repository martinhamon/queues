<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Patient;
class Caller extends Component
{
    public $patients;

    public function mount()
    {
        $this->patients = \App\Models\Patient::all();
    }

    public function render()
    {
        return view('livewire.caller')->layout('layouts.app');;
    }


    
    public function callPatient($patient)
    {
       
        broadcast(new \App\Events\PatientCall(Patient::find($patient)));
    }
}
