@extends('layouts.app')

@section('background')
    <img src="{{ asset('.images/pozadie_index3.jpg') }}" alt="pozadie_index" class="background-image">
@endsection

@section('content')
    <div class="container">
        <h1>Ambulancie</h1>
        <div class="input-group mb-3">
            <input type="text" id="search-ambulance" class="form-control" placeholder="Vyhľadať ambulanciu..." aria-label="Search Ambulance">
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Názov</th>
                <th>Akcie</th>
            </tr>
            </thead>
            <tbody id="ambulances-table-body">
            </tbody>
        </table>
        <div class="add-ambulance-form">
            <h2></h2>
            <form action="{{ route('ambulances.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Názov ambulancie" required>
                </div>
                <button type="submit" class="btn btn-success">Pridať novú ambulanciu</button>
            </form>
        </div>
    </div>

        <script>
            $(document).ready(function() {
                function searchAmbulances(query) {
                    $.ajax({
                        url: "{{ route('ambulances.search') }}",
                        type: "GET",
                        data: { search: query },
                        success: function(data) {
                            var tbody = $('#ambulances-table-body');
                            tbody.empty();
                            if(data.length > 0) {
                                data.forEach(function(ambulance) {
                                    tbody.append(
                                        `<tr>
                                    <td>${ambulance.name}</td>
                                    <td>
                                        <a href="/ambulances/${ambulance.id}/edit" class="btn btn-primary">Aktualizovať</a>
                                    </td>
                                </tr>`
                                    );
                                });
                            } else {
                                tbody.append('<tr><td colspan="2">Žiadne zhody.</td></tr>');
                            }
                        }
                    });
                }

                searchAmbulances('');

                $('#search-ambulance').on('input', function() {
                    searchAmbulances(this.value);
                });
            });
        </script>



@endsection
