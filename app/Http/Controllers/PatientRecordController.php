<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;

class PatientRecordController extends Controller
{
    public function show($patientId)
    {
        if (!auth()->user()->isDoktor() && !auth()->user()->isAdmin()) {
            abort(403);
        }

        $patient = Patient::with('records')->findOrFail($patientId);
        return view('patients.patient_records', compact('patient'));
    }

    public function store(Request $request, $patientId)
    {
        $request->validate([
            'subjective_complaints' => 'nullable|string',
            'objective_findings' => 'required|string',
            'diagnosis' => 'nullable|string',
            'previous_treatment' => 'nullable|string',
            'requested' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $user = auth()->user();

        PatientRecord::create([
            'patient_id' => $patientId,
            'doctor_name' => auth()->user()->name,
            'subjective_complaints' => $request->input('subjective_complaints'),
            'objective_findings' => $request->input('objective_findings'),
            'diagnosis' => $request->input('diagnosis'),
            'previous_treatment' => $request->input('previous_treatment'),
            'requested' => $request->input('requested'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('patient.records.show', $patientId)->with('success', 'Záznam bol úspešne pridaný.');
    }

}
