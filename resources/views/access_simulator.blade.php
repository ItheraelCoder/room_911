<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso ROOM_911</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card p-5 text-center" style="width: 400px;">
        <h1 class="card-title mb-4">ROOM_911</h1>
        <h5 class="mb-4">Módulo de Acceso</h5>

        @if (session('status'))
            <div class="alert alert-info">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('access.attempt') }}">
            @csrf
            <div class="mb-3">
                <input type="text" class="form-control text-center" name="internal_id" placeholder="ID Interno del Empleado" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Registrar Acceso</button>
        </form>
    </div>
</body>
</html>