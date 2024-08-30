<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Office extends Component
{

    public $description;
    public $number;
    public $message;
    public function render()
    {
        return view('livewire.office')->layout('layouts.app');
    }

    public function store()
    {

        Log::info('Office:store '.$this->description);
        \App\Models\Office::firstOrCreate([
            'description' => $this->description,
            'number' => $this->number
        ]);
        $this->message = $this->description . ' creado con éxito';
        $this->description = '';
        $this->number = '';
        
    }
}
