<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Centro de costo</title>
</head>
<script>
    window.confirmarEliminacion = function(url) {
        if (confirm('¿Desea eliminar este Producto?')) {
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
            <h2>Crear producto</h2>
            <form action="crearProducto" method="post">
                @csrf
                <label for="nombre">Descripcion del producto</label>
                <input type="text" id="Descripcion" name="Descripcion" value="{{ old('Descripcion') }}" required>
                <label for="nombre">Valor</label>
                <input type="text" id="Valor" name="Valor" value="{{ old('Valor') }}" required>
                <label for="nombre">Laboratorio</label>
                <input type="text" id="Laboratorio" name="Laboratorio" value="{{ old('Laboratorio') }}" required>
                <label for="nombre">Proveedor</label>
                <select name="ID_Proveedor" class="select" required>
                    <option value="">Seleccione un privilegio</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->ID }}">{{ $proveedor->RazonSocial }}</option>
                    @endforeach
                </select><br>
                <input type="submit" value="Crear Producto">
            </form>
        </div>
        <div>
            <h2>Listado de productos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Descripcion</th>
                        <th>Valor</th>
                        <th>Laboratorio</th>
                        <th>Proveedor</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->ID }}</td>
                    <td>{{ $producto->Descripcion }}</td>
                    <td>$ {{ number_format($producto->Valor, 0, ',', '.') }} CLP</td>
                    <td>{{ $producto->Laboratorio }}</td>
                    <td>{{ $producto->proveedor ? $producto->proveedor->RazonSocial : 'Sin Asignar' }}</td>
                    <td>
                        <!-- Botón "Examinar" -->
                        <button class="buttonExaminar" onclick="window.location='{{ route('examinarProducto', ['id' => $producto->ID]) }}'">Examinar</button>
                        <!-- Botón "Eliminar" -->
                        <button class="buttonEliminar" onclick="confirmarEliminacion('{{ route('eliminarProducto', ['id' => $producto->ID]) }}')">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>
<style>
    .select {
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

    .select option {
        padding: 8px;
        font-size: 16px;
        background-color: #fff;
        color: #333;
    }

    /* Estilos para cuando el select está enfocado */
    .select:focus {
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
