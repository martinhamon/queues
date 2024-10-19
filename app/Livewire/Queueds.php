<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Queued;
use Illuminate\Support\Facades\Log;

class Queueds extends Component
{
    public $description;
    public $queueds;
    public $queue_id;

    protected $rules = [
        'description' => 'required|string|max:255',
       
    ];

    public function mount()
    {
        $this->queueds = Queued::all();
      
    }

    public function submit()
    {
        try {
            $this->validate();

            Queued::create([
                'description' => $this->description,
            ]);

            session()->flash('message', 'Fila creada exitosamente.');
            $this->queueds = Queued::all();
            // Resetea los campos del formulario
            $this->reset(['description']);
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                session()->flash('error', 'Error: La fila  ya exixte.');
               
            } else {
                session()->flash('error', 'Error al crear la fila: ' );
                Log::error($e->getMessage());
            }
        }
    }


    public function render()
    {
        return view('livewire.queueds')->layout('layouts.app');
    }
}
