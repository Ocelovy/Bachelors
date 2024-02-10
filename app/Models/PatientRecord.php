<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'doctor_name', 'subjective_complaints', 'objective_findings', 'diagnosis', 'previous_treatment', 'requested', 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected $casts = [
        'date' => 'date',
    ];

}

