<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_queue extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'office_id',
        'priority',
        'status',
        'created_at',
        'updated_at',
    ];
}
