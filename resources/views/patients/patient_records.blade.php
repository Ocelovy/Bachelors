@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')

    <div class="container mt-3">
        <h3>Výmenný lístok</h3>
        <form action="{{ route('patient.records.store', $patient->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="subjective_complaints" class="form-label">Subj. obtiaže</label>
                    <textarea class="form-control" id="subjective_complaints" name="subjective_complaints"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="objective_findings" class="form-label">Objekt. nález<span class="text-danger">*</span></label>
                    <textarea class="form-control" id="objective_findings" name="objective_findings" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="diagnosis" class="form-label">Diagnóza</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="previous_treatment" class="form-label">Doterajšia liečba</label>
                    <textarea class="form-control" id="previous_treatment" name="previous_treatment"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="requested" class="form-label">Požadované</label>
                    <textarea class="form-control" id="requested" name="requested"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="medications" class="form-label">Lieky</label>
                    <textarea class="form-control" id="medications" name="medications"></textarea>
                </div>
            </div>
            <div class="row">
            <div class="col-md-3 mb-3">
                <label for="date" class="form-label">Dátum<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ambulance" class="form-label">Ambulancia<span class="text-danger">*</span></label>
                <select class="form-control" id="ambulance" name="ambulance_id" required>
                    <option value="">Vyberte ambulanciu</option>
                    @foreach($ambulances as $ambulance)
                        <option value="{{ $ambulance->id }}">{{ $ambulance->name }}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <button type="submit" class="btn btn-primary">Vytvoriť výmenný lístok</button>
        </form>
    </div>


    <div class="container">
        <h2> {{ $patient->title }} {{ $patient->name }} {{ $patient->titleAfter }}</h2>
        <div>
            <p><strong>Rodné číslo: </strong>{{ $patient->birth_number }}</p>
            <p><strong>Kód poisťovne: </strong>{{ $patient->insurance_code }}</p>
            <p><strong>Bydlisko: </strong>{{ $patient->address }}</p>
            <p><strong>Email: </strong>{{ $patient->email }}</p>
            <p><strong>Telefón: </strong>{{ $patient->phone }}</p>
            <p><strong>Kontaktná osoba: </strong>{{ $patient->contact_person }}</p>
            <p><strong>Poznámka: </strong>{{ $patient->note }}</p>

        </div>
        <div>
            <div class="container">
                <h3>Ambulancie</h3>
                <div class="accordion" id="ambulanceAccordion">
                    @foreach($patient->records->groupBy('ambulance_id') as $ambulanceId => $records)
                        @php
                            $ambulance = $ambulances->find($ambulanceId);
                            $isOpen = true;
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $ambulanceId }}">
                                <button class="accordion-button {{ $isOpen ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $ambulanceId }}" aria-expanded="{{ $isOpen ? 'true' : 'false' }}" aria-controls="collapse{{ $ambulanceId }}">
                                    {{ $ambulance->name ?? 'Nepridelená Ambulancia' }}
                                </button>
                            </h2>
                            <div id="collapse{{ $ambulanceId }}" class="accordion-collapse collapse {{ $isOpen ? 'show' : '' }}" aria-labelledby="heading{{ $ambulanceId }}">
                                <div class="accordion-body">
                                    @forelse($records as $record)
                                        <div class="record">
                                            <h4>Záznam doktora: {{ $record->doctor_name }}</h4>
                                            @if($record->subjective_complaints)
                                                <strong>Subjektívne obtiaže:</strong> {{ $record->subjective_complaints }}<br>
                                            @endif
                                            @if($record->objective_findings)
                                                <strong>Objektívny nález:</strong> {{ $record->objective_findings }}<br>
                                            @endif
                                            @if($record->diagnosis)
                                                <strong>Diagnóza:</strong> {{ $record->diagnosis }}<br>
                                            @endif
                                            @if($record->previous_treatment)
                                                <strong>Doterajšia liečba:</strong> {{ $record->previous_treatment }}<br>
                                            @endif
                                            @if($record->requested)
                                                <strong>Požadované:</strong> {{ $record->requested }}<br>
                                            @endif
                                            @if($record->medications)
                                                <strong>Lieky:</strong> {{ $record->medications }}<br>
                                            @endif
                                            <small class="record-time">{{ $record->date->format('d.m.Y') }}</small>
                                            <form action="{{ route('records.destroy', $record->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Odstrániť</button>
                                            </form>
                                            <br>
                                        </div>
                                    @empty
                                        <p>Zatiaľ žiadne záznamy.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection


