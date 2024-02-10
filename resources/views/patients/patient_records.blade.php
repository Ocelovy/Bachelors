@extends('layouts.app')

@section('content')
    {{-- Na začiatku alebo na konci súboru patient_records.blade.php --}}

    <div class="container mt-3">
        <h3>Pridať nový záznam</h3>
        <form action="{{ route('patient.records.store', $patient->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="subjective_complaints" class="form-label">Subj. obtiaže</label>
                <textarea class="form-control" id="subjective_complaints" name="subjective_complaints"></textarea>
            </div>
            <div class="mb-3">
                <label for="objective_findings" class="form-label">Objekt. nález<span class="text-danger">*</span></label>
                <textarea class="form-control" id="objective_findings" name="objective_findings"></textarea>
            </div>
            <div class="mb-3">
                <label for="diagnosis" class="form-label">Diagnóza<span class="text-danger">*</span></label>
                <textarea class="form-control" id="diagnosis" name="diagnosis" required></textarea>
            </div>
            <div class="mb-3">
                <label for="previous_treatment" class="form-label">Doterajšia liečba</label>
                <textarea class="form-control" id="previous_treatment" name="previous_treatment"></textarea>
            </div>
            <div class="mb-3">
                <label for="requested" class="form-label">Požadované</label>
                <textarea class="form-control" id="requested" name="requested"></textarea>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Dátum<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <button type="submit" class="btn btn-primary">Pridať záznam</button>
        </form>
    </div>



    <div class="container">
        <h2>Údaje o pacientovi: {{ $patient->name }}</h2>
        <div>
            <p>Rodné číslo: {{ $patient->birth_number }}</p>
            <p>Kód poisťovne: {{ $patient->insurance_code }}</p>
            <p>Bydlisko: {{ $patient->address }}</p>
        </div>
        <div>
            <h3>Záznamy</h3>
            @forelse($patient->records as $record)
                <div class="record">
                    <p class="label">Dátum: {{ $record->date->toDateString() }}</p>
                    <p class="label">Meno doktora: {{ $record->doctor_name }}</p>
                    <p>Subjektívne obtiaže: {{ $record->subjective_complaints }}</p>
                    <p>Objektívny nález: {{ $record->objective_findings }}</p>
                    <p>Diagnóza: {{ $record->diagnosis }}</p>
                    <p>Doterajšia liečba: {{ $record->previous_treatment }}</p>
                    <p>Požadované: {{ $record->requested }}</p>
                </div>
            @empty
                <p>Žiadne záznamy.</p>
            @endforelse
        </div>
    </div>
@endsection


