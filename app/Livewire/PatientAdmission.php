<?php

namespace App\Livewire;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PatientAdmission extends Component
{
    public $patient_name;
    public $patient_lastname;
    public $patient_dni;
    public $patients;
    public $enable = false;


    public function render()
    {
        if (strlen($this->patient_dni) >= 7) {
            $this->patient_dni = str_replace(' ', '', $this->patient_dni);
            Log::info('DNI paciente: ' . $this->patient_dni);

            $this->patients = Patient::where('dni', 'like', '%' . $this->patient_dni . '%')->get();
        } else {
            Log::info('Es vacio: ');
            $this->patients = [];
        }
        return view('livewire.patient-admission', [
            'patients' =>  $this->patients
        ])->layout('layouts.app');
    }

    public function save()
    {

        $this->validate([
            'patient_name' => 'required',
            'patient_lastname' => 'required',
            'patient_dni' => 'required',
        ]);
        Log::info('Guardado ');
        $patient = new Patient();
        $patient->name = $this->patient_name;
        $patient->lastname = $this->patient_lastname;
        $patient->dni = $this->patient_dni;
        $patient->save();

        $this->patient_name = '';
        $this->patient_lastname = '';
        $this->patient_dni = '';
    }
}
