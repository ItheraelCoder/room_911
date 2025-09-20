<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Accesos - {{ $employee->first_name }} {{ $employee->last_name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @extends('layouts.admin')
    
    @section('title', 'History')
    
    @section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Historial de Accesos de {{ $employee->first_name }} {{ $employee->last_name }}</h1>
        <div class="card p-4 mb-4">
            <form action="{{ route('employees.history', $employee) }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 d-flex">
                        <button type="submit" class="btn btn-primary me-2">Filtrar</button>
                        <a href="{{ route('employees.history.pdf', array_merge(['employee' => $employee->id], request()->query())) }}" class="btn btn-danger">Descargar PDF</a>
                    </div>
                </div>
            </form>
        </div>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Hora de Acceso</th>
                    <th>Estado</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($accessLogs as $log)
                    <tr>
                        <td>{{ $log->access_time }}</td>
                        <td>{{ $log->access_status }}</td>
                        <td>{{ $log->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
</body>
</html>