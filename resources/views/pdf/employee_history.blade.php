<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Accesos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Historial de Accesos a ROOM_911</h1>
    <h2>Empleado: {{ $employee->first_name }} {{ $employee->last_name }} (ID: {{ $employee->internal_id }})</h2>
    
    <table>
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
</body>
</html>