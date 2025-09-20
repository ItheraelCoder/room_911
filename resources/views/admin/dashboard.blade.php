<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Administrativo - ROOM_911</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Menú Administrativo</h1>
        <div class="d-flex justify-content-end mb-3">
             <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#importModal">
        Importar Empleados
    </button>
            <a href="{{ route('employees.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Registrar Nuevo Empleado
            </a>
        </div>
        <div class="card p-4 mb-4">
            <h5 class="card-title">Buscar y Filtrar Empleados</h5>
            <form action="{{ route('admin.dashboard') }}" method="GET">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Buscar por ID, nombre o apellido</label>
                        <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="department_id" class="form-label">Filtrar por Departamento</label>
                        <select class="form-select" id="department_id" name="department_id">
                            <option value="">Todos</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" @if(request('department_id') == $department->id) selected @endif>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Buscar</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Limpiar Filtros</a>
                    </div>
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID de Empleado</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Departamento</th>
                        <th>Acceso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->internal_id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->last_name }}</td>
                        <td>{{ $employee->department->name }}</td>
                        <td>
                            @if ($employee->has_access)
                                <span class="badge bg-success">Concedido</span>
                            @else
                                <span class="badge bg-danger">Denegado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning btn-sm">Editar</a>
                            <a href="{{ route('employees.history', $employee) }}" class="btn btn-info btn-sm">Historial</a>
                            <form action="{{ route('employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $employees->links() }}
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Importar Empleados (CSV)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="csv_file" class="form-label">Seleccione un archivo CSV</label>
                        <input class="form-control" type="file" id="csv_file" name="file" required>
                        <small class="text-muted">El archivo debe tener las columnas: internal_id, first_name, last_name, department_id, has_access.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>