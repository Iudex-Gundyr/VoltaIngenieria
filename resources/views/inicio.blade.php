<!DOCTYPE html>
<html>
<head>
    <title>Página web en mantenimiento</title>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
       <style>
        /*TIPOGRAFÍAS*/
        @import url('https://fonts.googleapis.com/css?family=Noto+Sans');
        /*INICIALIZACIÓN DE ESTILOS*/
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{background-color:#f6f6f6;}

        /*PERSONALIZACIÓN DE P.MANTENIMIENTO*/
        .mantenimiento{
            width:600px;
            height:400px;
            padding:32px;
            border:1px solid #000;
            border-radius:10px;
            margin-top:-200px;
            margin-left:-300px;
            background-color:#fff;
            position:fixed;
            top:50%;
            left:50%;
        }
        .mantenimiento h1, .mantenimiento h2, .mantenimiento p{
            font-family:"noto sans", sans-serif;
        }

        .mantenimiento h1{
            font-size:2em;
            text-align:center;
            padding:6px;
        }
        .mantenimiento h2{
            font-size:2em;
            font-style:italic;
        }
        .mantenimiento p{
            margin:16px 0;
            line-height:1.5em;
        }
               .boton-contacto {
            background-color: #007bff; /* Azul */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px; /* Espacio debajo del botón */
            margin-top: 20px; /* Margen superior */
        }

        /* Estilo para el botón al pasar el mouse */
        .boton-contacto:hover {
            background-color: #0056b3; /* Azul más oscuro */
        }

    </style>
</head>
<body>
    <div class="mantenimiento">
        <h1>Página VOLTAINGENIERIA en construcción</h1>
        <p>Nuestro sitio web se encuentra en mantenimiento. Estamos trabajando muy duro para brindarle la mejor experiencia.</p>
        <p>¿Necesitas contactarnos? Escríbenos a <a href="mailto:contacto@voltaingenieria.cl">contacto@voltaingenieria.cl</a></p>

    </div>

    <center><a href="/Login" class="boton-contacto">Intranet</a></center>


</body>
</html>
