<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Proveedor</title>
</head>
<script>
    window.confirmarEliminacion = function(url) {
        if (confirm('¿Desea eliminar este Proveedor?')) {
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
            <h2>Crear Proveedor</h2>
            <form action="{{ route('crearProveedor') }}" method="post">
                @csrf
                <label for="rut">RUT:</label>
                <input type="text" id="rut" name="Rut" value="{{ old('Rut') }}" required>

                <label for="razon_social">Razon Social:</label>
                <input type="text" id="razon_social" name="RazonSocial" value="{{ old('RazonSocial') }}" required>

                <label for="giro">Giro:</label>
                <input type="text" id="giro" name="Giro" value="{{ old('Giro') }}" required>

                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="Direccion" value="{{ old('Direccion') }}" required>

                <label for="mail">Mail:</label>
                <input type="email" id="mail" name="Mail" value="{{ old('Mail') }}" required>

                <label for="telefono">Teléfono:</label>
                <input type="text" id="telefono" name="Telefono" value="{{ old('Telefono') }}" required>

                <input type="submit" value="Crear Proveedor">
            </form>


        </div>
        <div>
            <h2>Listado de Proveedores</h2>
            <table>
                <thead>
                    <tr>
                        <th>Rut</th>
                        <th>Razon Social</th>
                        <th>Giro</th>
                        <th>Direccion</th>
                        <th>Mail</th>
                        <th>Telefono</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->Rut }}</td>
                        <td>{{ $proveedor->RazonSocial }}</td>
                        <td>{{ $proveedor->Giro }}</td>
                        <td>{{ $proveedor->Direccion }}</td>
                        <td>{{ $proveedor->Mail }}</td>
                        <td>{{ $proveedor->Telefono }}</td>
                        <td><button class="buttonExaminar" onclick="window.location='{{ route('examinarProveedor', ['id' => $proveedor->ID]) }}'">Examinar</button>
                            <form id="eliminarProveedorForm" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button onclick="confirmarEliminacion('{{ route('eliminarProveedor', ['id' => $proveedor->ID]) }}')" class="buttonEliminar">Eliminar</button></td>
                    </tr>
                    @endforeach
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
