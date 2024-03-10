<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\Patient;
use App\Models\PatientRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientRecordController extends Controller
{
    public function show($patientId)
    {
        if (!auth()->user()->isDoktor() && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $user = Auth::user();
        $ambulances = Ambulance::All();//$user->ambulances;

        $patient = Patient::with('records')->findOrFail($patientId);

        return view('patients.patient_records', compact('patient', 'ambulances'));
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
            'medications' => 'nullable|string',
        ]);

        $user = auth()->user();

        PatientRecord::create([
            'patient_id' => $patientId,
            'ambulance_id' => $request->ambulance_id,
            'doctor_name' => auth()->user()->name,
            'subjective_complaints' => $request->input('subjective_complaints'),
            'objective_findings' => $request->input('objective_findings'),
            'diagnosis' => $request->input('diagnosis'),
            'previous_treatment' => $request->input('previous_treatment'),
            'requested' => $request->input('requested'),
            'date' => $request->input('date'),
            'medications' => $request->input('medications'),
        ]);

        return redirect()->route('patient.records.show', $patientId)->with('success', 'Záznam bol úspešne pridaný.');
    }

    public function destroy($recordId)
    {
        $record = PatientRecord::findOrFail($recordId);
        $patientId = $record->patient_id;
        $record->delete();

        return redirect()->route('patient.records.show', $patientId)
            ->with('success', 'Záznam bol úspešne odstránený.');
    }


}
