<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScrumApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoÇTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <script src="node_modules/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container-fluid pb-5">
            <div class="row">
                <div class="col-12">
                    {{-- Error handling meldingen --}}
                    @if (Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <div class="col-12">
                                <div class="row">
                                    @php
                                        $collectionOfActiveGroups = [];
                                        $collectionOfInactiveGroups = [];
                                    @endphp
                                    @foreach ($groups as $group)
                                        @php
                                            if ($group->status === 0) {
                                                $collectionOfActiveGroups[] = $group;
                                            } else {
                                                $collectionOfInactiveGroups[] = $group;
                                            }
                                        @endphp
                                    @endforeach
                                    {{-- Checkboxes --}}
                                    <div class="content">
                                        <label for="showActive">Toon active groepen:</label>
                                        <input type="checkbox" id="showActive" class="checkbox" checked>

                                        <label for="showArchived">Toon gearchiveerde groepen:</label>
                                        <input type="checkbox" id="showArchived" class="checkbox">
                                    </div>

                                    <div id="active" class="content">
                                        <div class="row">
                                            <h4>Active groepen:</h4>
                                            @foreach ($collectionOfActiveGroups as $group)
                                                <div class="col-md-3">
                                                    <div class="card shadow rounded-3 bg-body border-0 mt-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $group->naam }}</h5>
                                                            @foreach ($group->users as $user)
                                                                <li class="d-flex align-items-center">
                                                                    @php
                                                                        $aanwezigheid = IsStudentAanwezig($user->id) ? true : false;
                                                                        $dotBackgroundColor = $aanwezigheid ? 'green' : 'red';
                                                                    @endphp
                                                                    <div
                                                                        style="width: 20px; height: 20px; background-color: {{ $dotBackgroundColor }}; border-radius: 50%; margin-right: 10px;">
                                                                    </div>
                                                                    <span>{{ $user->name }}</span>
                                                                </li>
                                                            @endforeach
                                                            <br>

                                                            <button class="btn btn-danger" type="submit"
                                                                onclick="Archiveergroep('<?php echo $group->id; ?>', )">Archiveer</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div id="archived" class="content">
                                        <div class="row">
                                            <h4>Gearchiveerde groepen:</h4>
                                            @foreach ($collectionOfInactiveGroups as $group)
                                                <div class="col-md-3">
                                                    <div class="card shadow rounded-3 bg-body border-0 mt-3">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $group->naam }}</h5>
                                                            @foreach ($group->users as $user)
                                                                <li class="d-flex align-items-center">
                                                                    @php
                                                                        $aanwezigheid = IsStudentAanwezig($user->id) ? true : false;
                                                                        $dotBackgroundColor = $aanwezigheid ? 'green' : 'red';
                                                                    @endphp
                                                                    <span>{{ $user->name }}</span>
                                                                </li>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif (auth()->user()->hasRole('student'))
                            @if (isset($groep[0]))
                                <div class="col-12">
                                    <div class="card shadow rounded-3 bg-body border-0 m-4">
                                        <div class="card-body">
                                            <h3>{{ $groep[0]->naam }}</h3>
                                            <h5>Leden:</h5>
                                            @foreach ($groep[0]->users as $user)
                                                <li class="d-flex align-items-center">
                                                    @php
                                                        $aanwezigheid = IsStudentAanwezig($user->id) ? true : false;
                                                        $dotBackgroundColor = $aanwezigheid ? 'green' : 'red';
                                                    @endphp
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: {{ $dotBackgroundColor }}; border-radius: 50%; margin-right: 10px;">
                                                    </div>
                                                    <span>{{ $user->name }}</span>
                                                </li>
                                            @endforeach
                                            <br>
                                            <form action="{{ route('stelVraag') }}" method="POST">
                                                @csrf
                                                <input type="text" name="vraag" id="vraag" class="form-control w-50"
                                                    placeholder="Uw vraag hier...">
                                                <button class="btn btn-primary" type="submit">Stel een vraag</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endauth
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-6">
                    @auth
                        @if (auth()->user()->hasRole('admin'))
                            <div class="card shadow rounded-3 bg-body border-0 mt-3">
                                <div class="card-body">
                                    <h1 class="card-title">Vragen:</h1>
                                    @php
                                        $vragen = GetAllActiveVragen();
                                    @endphp
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Vraag</th>
                                            <th>Steller</th>
                                            <th>Verwijder</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($vragen as $vraag)
                                                <tr>
                                                    <td>{{ $vraag->vraag }}</td>
                                                    <td>{{ GetUsersNameById($vraag->userId) }}</td>
                                                    <td>
                                                        <button class="btn btn-danger" type="submit"
                                                            onclick="Popup('<?php echo $vraag->id; ?>', )">Verwijder</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <div class="card shadow rounded-3 bg-body border-0 mt-3">
                                <div class="card-body">
                                    <h1 class="card-title">Door jou gestelde vragen:</h1>
                                    @php
                                        $vragen = GetAllOwnActiveVragen();
                                    @endphp
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Vraag</th>
                                        </thead>
                                        <tbody>
                                            @if (count($vragen) != 0)
                                                @foreach ($vragen as $vraag)
                                                    <tr>
                                                        <td>{{ $vraag->vraag }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                        Je hebt zelf geen vragen gesteld.
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="col-6">
                    <div class="card shadow rounded-3 bg-body border-0 mt-3">
                        <div class="card-body">
                            <h1 class="card-title">Opkomende lessen:</h1>
                            <table class="table table-striped">
                                <thead>
                                    <th>Status</th>
                                    <th>Naam</th>
                                    <th>Klas</th>
                                    <th>Datum</th>
                                    <th>Min, Max</th>
                                    <th>Aanmeldingen</th>
                                    @auth
                                        @if (auth()->user()->hasRole('student'))
                                            <th>Aanmelden</th>
                                        @endif
                                    @endauth
                                </thead>
                                <tbody>
                                    @foreach ($upcommingLessons as $les)
                                        @php
                                            $aangemeld = isUserAangemeld($les->id);
                                        @endphp
                                        @php
                                            $aanmeldingen = GetLesCount($les->id);
                                        @endphp
                                        <tr>
                                            <td>
                                                @php
                                                    $kleur = $aanmeldingen >= $les->min ? 'green' : 'red';
                                                @endphp
                                                @if ($kleur === 'green')
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: green; border-radius: 50%;">
                                                    </div>
                                                @elseif($kleur === 'red')
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: red; border-radius: 50%;">
                                                    </div>
                                                @else
                                                    <div
                                                        style="width: 20px; height: 20px; background-color: gray; border-radius: 50%;">
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $les->naam }}</td>
                                            <td>{{ $les->klas }}</td>
                                            <td>
                                                @php
                                                    echo date_format(new DateTime($les->start), 'd-m H:i');
                                                @endphp
                                            </td>
                                            <td>{{ $les->min }}, {{ $les->max }}</td>
                                            <td>
                                                <p>{{ $aanmeldingen }}</p>
                                            </td>
                                            @auth
                                                @if (auth()->user()->hasRole('student'))
                                                    <td>
                                                        @if ($aangemeld === false)
                                                            @if ($aanmeldingen < $les->max)
                                                                <form action="{{ route('aanmelden', ['id' => $les->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Aanmelden</button>
                                                                </form>
                                                            @else
                                                                <p>Vol!</p>
                                                            @endif
                                                        @else
                                                            <p>Aangemeld</p>
                                                        @endif
                                                    </td>
                                                @endif
                                            @endauth
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add this modal to your Blade template or layout file -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this question?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form id="deleteForm" action="" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
</body>
<script>
    window.addEventListener("DOMContentLoaded", () => {
        const showActiveCheckbox = document.getElementById("showActive");
        const showArchivedCheckbox = document.getElementById("showArchived");
        const activeDiv = document.getElementById("active");
        const archivedDiv = document.getElementById("archived");

        // Initially hide the archived content
        archivedDiv.style.display = "none";

        showActiveCheckbox.addEventListener("change", function() {
            activeDiv.style.display = this.checked ? "block" : "none";
        });

        showArchivedCheckbox.addEventListener("change", function() {
            archivedDiv.style.display = this.checked ? "block" : "none";
        });
    });
</script>
<script>
    function Popup(id) {
        Swal.fire({
            title: 'Weet je zeker dat je deze vraag wil verwijderen?',
            showDenyButton: true,
            confirmButtonText: 'Ja',
            denyButtonText: `Nee`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                console.log(id);
                window.location.href = "{{ route('VerwijderVraag', '') }}" + "/" + id;
            } else if (result.isDenied) {}
        })
    }

    function Archiveergroep(id) {
        Swal.fire({
            title: 'Weet je zeker dat je deze groep wil archiveren?',
            showDenyButton: true,
            confirmButtonText: 'Ja',
            denyButtonText: `Nee`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                console.log(id);
                window.location.href = "{{ route('archiveerGroep', '') }}" + "/" + id;
            } else if (result.isDenied) {}
        })
    }
</script>

</html>
