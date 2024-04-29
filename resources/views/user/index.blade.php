@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index2.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('alert'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('alert') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @can('create', \App\Models\User::class)
                    <div class="mb-3">
                        <a href="{{ route('user.create') }}" class="btn btn-success" role="button"><i class="bi bi-plus-circle"></i> Pridať používateľa</a>
                    </div>
                @endcan

                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Meno</th>
                            <th>Email</th>
                            <th>Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isDoktor() || auth()->user()->isStaff()))
                                        @can('update', $user)
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-primary btn-sm">Upraviť</a>
                                        @endcan
                                            @can('delete', $user)
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Zmazať</button>
                                        @endcan
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                        <div class="pagination">
                            @if ($users->onFirstPage())
                                <span class="btn btn-secondary disabled">Predchádzajúci</span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" class="btn btn-primary">Predchádzajúci</a>
                            @endif

                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary">Nasledujúci</a>
                            @else
                                <span class="btn btn-secondary disabled">Nasledujúci</span>
                            @endif
                        </div>


            </div>
        </div>
    </div>
@endsection
