<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Navbar Superior</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar-superior {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            z-index: 1000; /* Asegura que esté por encima del otro navbar */
        }
        .navbar-superior h1 {
            margin: 0;
            font-size: 24px;
        }
        .navbar-superior ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .navbar-superior ul li {
            margin-left: 10px;
        }
        .navbar-superior ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar-superior ul li a:hover {
            background-color: #555;
        }

        /* Estilos para el menú desplegable */
        .dropdown {
            position: relative;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #333;
            min-width: 150px;
            z-index: 1000; /* Asegura que esté por encima del navbar superior */
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown-content a {
            color: #fff;
            padding: 10px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
        }
        .dropdown-content a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<nav class="navbar-superior">
    <h1></h1>
    <ul>
        <li class="dropdown">
            <a href="#">RRHH</a>
            <div class="dropdown-content">
                <a href="/SolicitudCompra">Solicitud de compra</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Herramientas</a>
            <div class="dropdown-content">
                <a href="/Usuarios">Usuarios</a>
                <a href="/Cc">Centros de Costos</a>
                <a href ="/Productos">Productos</a>
                <a href ="/Proveedor">proveedor</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf

            </form>
        </li>
    </ul>
</nav>

</body>
</html>
