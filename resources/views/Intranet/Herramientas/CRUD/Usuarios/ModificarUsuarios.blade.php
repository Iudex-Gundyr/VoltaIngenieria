<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Examinando usuario</title>
</head>
<script>
    window.confirmarEliminacion = function(url) {
        if (confirm('¿Desea eliminar el privilegio de este usuario?')) {
            window.location.href = url;
        }
    };
</script>
<body>
    @include('Intranet/Navbar')
    @if($errors->any())
        <div class="alert alert-danger" style="background: red">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success" style="background: rgb(2, 238, 2)">
            {{ session('success') }}
        </div>
    @endif
    <div class="container">
        <div>
            <h2>Modificando al usuario {{ $usuario->Nombre }}</h2>
            <form action="{{ route('actualizarUsuario', ['id' => $usuario->ID]) }}" method="post">
                @csrf
                @method('PUT') <!-- Agrega este método para indicar que estás realizando una solicitud PUT -->
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $usuario->Nombre }}" required>

                <label for="rut">Rut:</label>
                <input type="text" id="rut" name="rut" value="{{ $usuario->Rut }}" required>

                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" value="{{ $usuario->Departamento }}" required>

                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" value="{{ $usuario->Correo }}" required>

                <label for="contrasena">Contraseña (Si no desea modificar dejar vacio):</label>
                <input type="password" id="contrasena" name="contrasena">

                <input type="submit" value="Modificar Usuario">
            </form>


        </div>
        <div>
            <h2>Privilegios del usuario {{ $usuario->Nombre }}</h2>
            <form action="{{ route('agregarPrivilegio') }}" method="POST">
                @csrf
                <input type="hidden" name="ID_Usuario" value="{{ $usuario->ID }}">
                <select name="ID_Privilegio" class="select-privilegio">
                    <option value="">Seleccione un privilegio</option>
                    @foreach($privilegio as $p)
                        <option value="{{ $p->ID }}">{{ $p->NPrivilegio }}</option>
                    @endforeach
                </select><br>
                <input type="submit" value="Agregar privilegio">
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Privilegio</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($privilegiosUsuario as $privilegioUsuario)
                        <tr>
                            <td>{{ $privilegioUsuario->privilegio->NPrivilegio }}</td>
                            <td><button onclick="confirmarEliminacion('{{route('eliminarPrivilegio',['id'=> $privilegioUsuario->ID])}}')" class="buttonEliminar">Eliminar</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<style>
    .select-privilegio {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
        background-color: #fff;
        cursor: pointer;
        outline: none;
        margin-bottom: 3%;
    }

    .select-privilegio option {
        padding: 8px;
        font-size: 16px;
        background-color: #fff;
        color: #333;
    }

    /* Estilos para cuando el select está enfocado */
    .select-privilegio:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
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
            margin-top: 3%;
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
