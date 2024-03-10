@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <h1>Priradiť zamestnancov k ambulancii: <br> {{ $ambulance->name }}</h1>

        <form action="{{ route('ambulances.users.assign', $ambulance) }}" method="POST">
        @csrf
            <select name="user_ids[]" multiple class="form-control mb-2">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-success mb-3">Priradiť</button>
        </form>

        <h2>Aktuálni zamestnanci:</h2>
        <ul class="list-group">
            @foreach($ambulance->users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $user->name }}
                    <form action="{{ route('ambulances.users.remove', ['ambulance' => $ambulance, 'user' => $user]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Odstrániť</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
