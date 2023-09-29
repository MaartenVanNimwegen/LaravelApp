<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Voeg les toe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="row justify-content-center mt-5">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">Voeg les toe</h1>
                    </div>
                    <div class="card-body">
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
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('addLes') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Naam:</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="OOP basis" required>
                            </div>
                            <div class="mb-3">
                                <label for="info" class="form-label">Informatie:</label>
                                <input type="text" name="info" class="form-control" id="info"
                                    placeholder="De basis van OOP" required>
                            </div>
                            <div class="mb-3">
                                <label for="klas" class="form-label">Klas:</label>
                                <input type="text" name="klas" class="form-control" id="klas"
                                    placeholder="SEITO21A" required>
                            </div>
                            <div class="mb-3">
                                <label for="klas" class="form-label">Start:</label>
                                <input type="datetime-local" name="start" class="form-control" id="start" required>
                            </div>
                            <div class="mb-3">
                                <label for="min" class="form-label">Minimaal aantal leerlingen:</label>
                                <input class="form-control" type="number" name="min" id="min" value="1"><br>
                                <label for="max" class="form-label">Maximaal aantal leerlingen:</label>
                                <input class="form-control" type="number" name="max" id="max" value="20"><br>
                            </div>
                            <div class="mb-3">
                                <div class="d-grid">
                                    <button class="btn btn-primary">Opslaan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>
