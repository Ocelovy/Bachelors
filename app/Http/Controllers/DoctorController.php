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

    public function updateSpecialization(Request $request, $doctorId) {
        $validatedData = $request->validate([
            'specialization' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'additional_contact' => 'nullable|string|max:50',
        ]);

        $doctor = Doctor::findOrFail($doctorId);
        $doctor->update($validatedData);

        return redirect()->back()->with('success', 'Údaje boli aktualizované úspešne.');
    }

}
