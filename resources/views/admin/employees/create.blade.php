<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Empleado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Registrar Nuevo Empleado</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="internal_id" class="form-label">ID Interno</label>
                <input type="text" class="form-control" id="internal_id" name="internal_id" value="{{ old('internal_id') }}" required>
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            </div>
            <div class="mb-3">
                <label for="department_id" class="form-label">Departamento</label>
                <select class="form-select" id="department_id" name="department_id" required>
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" @if(old('department_id') == $department->id) selected @endif>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="has_access" name="has_access" value="1" checked>
                <label class="form-check-label" for="has_access">
                    Conceder Acceso al ROOM_911
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>