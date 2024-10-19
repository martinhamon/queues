<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Office extends Component
{

    public $description;
    public $number;
    public $message;
    public $queues;
    public $queued_id;
    public $error;

    public function mount()
    {
        $this->queues = \App\Models\Queued::all();
    }

    public function render()
    {
        return view('livewire.office')->layout('layouts.app');
    }

    public function store()
    {
        try {
            $this->validate([
                'description' => 'required',
                'number' => 'required',
                'queued_id' => 'required',
            ]);
            Log::info('Office:store ' . $this->description);
            \App\Models\Office::firstOrCreate([
                'description' => $this->description,
                'number' => $this->number,
                'queue_id' => $this->queued_id,

            ]);

            $this->message = $this->description . ' creado con éxito';
            $this->description = '';
            $this->number = '';
        } catch (ValidationException $e) {
            $this->error = 'Error: Todos los campos son obligatorios.';
          
        }
    }
}
