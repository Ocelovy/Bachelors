<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();

        return view('kontakt', ['doctors' => $doctors]);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function patientRecords()
    {
        return $this->hasMany(PatientRecord::class, 'doctor_id');
    }

    public function updateSpecialization(Request $request, Doctor $doctor)
    {
        $request->validate([
            'specialization' => 'required|string',
        ]);

        $doctor->specialization = $request->specialization;
        $doctor->save();

        return back()->with('success', 'Špecializácia bola úspešne aktualizovaná.');
    }

}
