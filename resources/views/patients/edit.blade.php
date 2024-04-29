@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <h2>Úprava pacienta</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-2">
                    <label for="inputTitle" class="form-label">Titul</label>
                    <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Zadajte titul" value="{{ $patient->title }}">
                </div>
                <div class="col-md-2">
                    <label for="inputTitleAfter" class="form-label">Titul za menom</label>
                    <input type="text" name="titleAfter" class="form-control" id="inputTitleAfter" placeholder="Zadajte titul za menom" value="{{ $patient->titleAfter }}">
                </div>
                <div class="col-md-8">
                    <label for="inputName" class="form-label">Meno a priezvisko<span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" id="inputName" placeholder="Zadajte celé meno" value="{{ $patient->name }}" required>
                </div>
            <div class="col-md-4">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Zadajte email" value="{{ $patient->email }}">
            </div>
            <div class="col-md-2">
                <label for="inputPhone" class="form-label">Telefónne číslo</label>
                <input type="tel" name="phone" class="form-control" id="inputPhone" placeholder="Zadajte telefónne číslo" value="{{ $patient->phone }}">
            </div>
            <div class="col-6">
                <label for="inputAddress" class="form-label">Adresa</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="Ulica, Mesto" value="{{ $patient->address }}">
            </div>
            <div class="form-group">
                <label for="birth_number" class="form-label form-heading">Rodné číslo:<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="birth_number" name="birth_number" value="{{ $patient->birth_number }}" required>
            </div>
            <div class="form-group">
                <label for="insurance_code" class="form-label form-heading">Kód poisťovne:<span class="text-danger">*</span></label>
                <select class="form-control custom-select" id="insurance_code" name="insurance_code"  required>
                    <option value="">Vyberte kód poisťovne</option>
                    <option value="24" {{ $patient->insurance_code == 24 ? 'selected' : '' }}>24 - DÔVERA</option>
                    <option value="25" {{ $patient->insurance_code == 25 ? 'selected' : '' }}>25 - VŠEOBECNÁ</option>
                    <option value="27" {{ $patient->insurance_code == 27 ? 'selected' : '' }}>27 – UNION </option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputContactPerson" class="form-label">Kontaktná osoba</label>
                <input type="text" name="contact_person" class="form-control" id="inputContactPerson" placeholder="Zadajte telefónne číslo kontaktnej osoby" value="{{ $patient->contact_person }}">
            </div>
            <div class="col-12">
                <label for="inputNote" class="form-label">Poznámka</label>
                <textarea name="note" class="form-control" id="inputNote" placeholder="Zadajte poznámku">{{ $patient->note }}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" id="updatePatientButton">Aktualizovať pacienta</button>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Zrušiť</a>
            </div>
        </form>
    </div>
@endsection
