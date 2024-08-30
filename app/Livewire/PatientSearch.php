<?php

namespace App\Livewire;

use App\Models\Patient;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Log;

class PatientSearch extends ModalComponent
{

    public $dni;
    public $name;
    public $surname;
    public $patients;


    public function mount()
    {
        $this->patients = null;
    }
    public function searchPatient()
    {


        if ($this->dni) {
            $query = Patient::query();
            $query->where('dni', 'like', '%' . $this->dni . '%');
            $this->patients = $query->take(5)->get();
        }

        if ($this->dni == "") {
            $this->patients = null;
        }
       
    }


    public function selectPatient($id)
    {
        $patient = Patient::find($id);
        $this->dni = $patient->dni;
        $this->name = $patient->name;
        $this->surname = $patient->lastname;
        $this->patients = null;

        Log::info('selectPatient ' . $this->dni);
        $this->dispatch('patient-find', $id);
    }
    public function render()
    {

        return view('livewire.patient-search', ['patients' => $this->patients]);
    }

    
}
