<?php

namespace App\Livewire;

use App\Models\office;
use App\Models\patient_queue;
use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use PhpParser\Node\Stmt\TryCatch;

class PatientAdmission extends Component
{
    public $patient_name;
    public $patient_lastname;
    public $patient_dni;
    public $patients;
    public $enable = false;
    public $offices;
    public $selectedOffice;
    public $patient_id;

    protected $rules = [

        'patient_name' => 'required',
        'patient_lastname' => 'required',
        'patient_dni' => 'required',
        'selectedOffice' => 'required',

    ];

    public function mount()
    {
        $this->offices = office::all();
        if ($this->offices->isNotEmpty()) {
            $this->selectedOffice = $this->offices->first()->id;
        }
    }


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
        try {

        $this->validate();
        }
        catch (ValidationException $e) {
            Log::info('Guardado '. $e->getMessage());
        }

       
        patient_queue::create([
            'patient_id' => $this->patient_id,
            'office_id' =>$this->selectedOffice,
           
            'priority' => 'low',
            'status' => 'waiting',
        ]);

       
        $this->patient_name = '';
        $this->patient_lastname = '';
        $this->patient_dni = '';
    }

    #[On('patient-find')]
    public function showCaller($id = null)
    {
        $patient = Patient::find($id);
        $this->patient_id=$patient->id;
        $this->patient_name = $patient->name;
        $this->patient_lastname = $patient->lastname;
        $this->patient_dni = $patient->dni;
        Log::info('showCaller ' . $id);
    }
}
