<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ScrumApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-9">

    </div>
    <div class="col-3">
      <h1>Opkomende lessen:</h1>
      <table class="table table-striped">
        <thead>
          <th>Naam</th>
          <th>Klas</th>
          <th>Datum</th>
          <th>Aanmeldingen</th>
        </thead>
        <tbody>
          @foreach($upcommingLessons as $les)
          <tr>
            <td>{{ $les->naam }}</td>
            <td>{{ $les->klas }}</td>
            <td>{{ $les->start }}</td>
            <td>Todo</td>
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