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
		<div class="col-9">
			@if(Session::has('success'))
					<div class="alert alert-success" role="alert">
							{{ Session::get('success') }}
					</div>
			@endif
			@if(Session::has('error'))
					<div class="alert alert-danger" role="alert">
							{{ Session::get('error') }}
					</div>
			@endif
						@auth
                                @if (auth()->user()->hasRole('admin'))
								@foreach ($groups as $group)
									{{ $group->name }}
									@foreach ($group->users as $user)
										{{ $user->name }}
									@endforeach
								@endforeach
								
                                @elseif (auth()->user()->hasRole('student'))
                                    {{ $groep[0]->naam }}
									@foreach ($groep[0]->users as $user)
										{{ $user->name }}
									@endforeach
										
									
                                @endif
                            @endauth
                </div>
                <div class="col-3">
                    <h1>Opkomende lessen:</h1>
                    <table class="table table-striped">
                        <thead>
                            <th>Naam</th>
                            <th>Klas</th>
                            <th>Datum</th>
                            @auth
                                @if (auth()->user()->hasRole('admin'))
                                    <th>Aanmeldingen</th>
                                @elseif (auth()->user()->hasRole('student'))
                                    <th>Aanmelden</th>
                                @endif
                            @endauth
                        </thead>
                        <tbody>
                            @foreach ($upcommingLessons as $les)
                                <tr>
                                    <td>{{ $les->naam }}</td>
                                    <td>{{ $les->klas }}</td>
                                    <td>{{ $les->start }}</td>
                                    @auth
                                        @if (auth()->user()->hasRole('admin'))
                                            <td>count</td>
                                        @elseif (auth()->user()->hasRole('student'))
                                            <td>
                                                <form action="{{ route('aanmelden', ['id' => $les->id]) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-primary" type="submit">Aanmelden</button>
                                                </form>
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
