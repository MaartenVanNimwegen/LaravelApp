<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScrumApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <div class="row">
                        @auth
                            @if (auth()->user()->hasRole('admin'))
                                @foreach ($groups as $group)
                                    <div class="col-md-4">
                                        <div class="card shadow rounded bg-body border-0 m-4">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $group->naam }}</h5>
                                                <ul>
                                                    @foreach ($group->users as $user)
                                                        <li>{{ $user->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif (auth()->user()->hasRole('student'))
                                @if (isset($groep[0]))
                                    <div class="col-md-4">
                                        <div class="card shadow rounded bg-body border-0 m-4">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $groep[0]->naam }}</h5>
                                                <ul>
                                                    @foreach ($groep[0]->users as $user)
                                                        <li>{{ $user->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="col-5">
                    <h1>Opkomende lessen:</h1>
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
                                    <td>{{ $les->start }}</td>
                                    <td>{{ $les->min }}, {{ $les->max }}</td>
                                    <td>
                                        <p>{{ $aanmeldingen }}</p>
                                    </td>
                                    @auth
                                        @if (auth()->user()->hasRole('student'))
                                            <td>
                                                @if ($aangemeld === false)
                                                    <form action="{{ route('aanmelden', ['id' => $les->id]) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-primary" type="submit">Aanmelden</button>
                                                    </form>
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
    @endsection

</body>

</html>
