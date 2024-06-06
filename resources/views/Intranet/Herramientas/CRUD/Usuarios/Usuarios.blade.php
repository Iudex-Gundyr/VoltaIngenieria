<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Usuarios</title>
</head>
<script>
    window.confirmarEliminacion = function(url) {
        if (confirm('¿Estás seguro de que deseas eliminar este usuario? AVISO: Recuerde que si el usuario tiene algún privilegio no podra eliminar el usuario.')) {
            window.location.href = url;
        }
    };
</script>
<body>
    @include('Intranet/Navbar')
    @if(session('error'))
    <div class="alert alert-danger" style="background: red">
        {{ session('error') }}
    </div>
@endif
    @if(session('success'))
        <div class="alert alert-success" style="background: rgb(2, 238, 2)">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div>
            <h2>Crear Usuario</h2>
            <form action="crearusuario" method="post">
                @csrf
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required>

                <label for="rut">Rut:</label>
                <input type="text" id="rut" name="rut" value="{{ old('rut') }}" required>

                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" value="{{ old('departamento') }}" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" value="{{ old('correo') }}" required>

                <label for="contrasena">Contraseña (la contraseña debe tener almenos 8 caracteres):</label>
                <input type="password" id="contrasena" name="contrasena" required>

                <input type="submit" value="Crear Usuario">
            </form>

        </div>
        <div>
            <h2>Usuarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Rut</th>
                        <th>Departamento</th>
                        <th>Correo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->Nombre }}</td>
                            <td>{{ $usuario->Rut }}</td>
                            <td>{{ $usuario->Departamento }}</td>
                            <td>{{ $usuario->Correo }}</td>
                            <td>
                                <!-- Botón "Examinar" -->
                                <button onclick="window.location.href='{{ route('examinarUsuario', ['id' => $usuario->ID]) }}'" class="buttonExaminar">Examinar</button>
                                <!-- Botón "Eliminar" -->
                                <button onclick="confirmarEliminacion('{{route('eliminarUsuario',['id'=> $usuario->ID])}}')" class="buttonEliminar">Eliminar</button>
                            </td>
                        </tr>
                    @endforeach
                    <!-- Aquí puedes añadir más filas con usuarios -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<style>
    .buttonEliminar{
        background-color: red;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    .buttonExaminar{
        background-color: blue;
        color: white;
        padding: 5px 10px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }
    .container {
        display: flex; /* Utilizar flexbox */
        height: auto; /* Ajustar la altura al 100% de la ventana */
    }
    .container > div {
        flex: 1; /* Cada div ocupará la misma cantidad de espacio */
        padding: 20px; /* Espacio alrededor del contenido */
        box-sizing: border-box; /* Incluir el padding en el tamaño del div */
        border: 1px solid #ccc; /* Borde para visualización */
    }
    h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 12px;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            max-width: 200px;
        }
        th {
            background-color: #4CAF50;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
</style>
