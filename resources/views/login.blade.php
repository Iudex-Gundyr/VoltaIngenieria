<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
</head>
<body>
    <form action="{{route('iniciarSesion')}}" method="POST">
        @csrf
        <h2>Inicio de sesión</h2>
        <input type="email" name="Correo" placeholder="Correo electrónico" >
        <input type="password" name="Contrasena" placeholder="Contraseña" >
        <label>
            <input type="checkbox" name="remember"> Recordarme
        </label>
        <button type="submit">Iniciar sesión</button>
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
    </form>
</body>
</html>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f4f4f4;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    button {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
