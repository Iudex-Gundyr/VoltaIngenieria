<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Solicitud Compra</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>

</head>
<body>
    @include('Intranet/Navbar')
    <div class="button-container">
        <button class="button" onclick="location.reload()">Limpiar orden de compra</button>
    </div>
<div class="order-container" id="imprimir">
    <div><img src="{{ asset('images/Logo.png') }}" alt="Logo de Volta" width="300" height="200"></div>
    <div class="order-header orden"><h3>Solicitud de compra<h3></div>
        <div class ="container">
            <div class="inner-div">
                RUT 76.657.504-8<br>
                LOS AROMOS N°8791, ANTOFAGASTA<br>
                FONO 63 2540545
            </div>
            <div class="inner-div2 container">
                <table class="custom-table">
                    <thead>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="right-align">Documento:</td>
                            <td class="right-align"><div id="resultado"></td>
                        </tr>
                        <tr>
                            <td class="right-align">Fecha:</td>
                            <td>{{ now()->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <td class="right-align">CC:</td>
                            <td>
                                <select name="centro_costo" class="small-select">
                                    <option value="">Selecciona un centro de costo</option>
                                    @foreach($centrosCosto as $centroCosto)
                                        <option value="{{ $centroCosto->ID }}">{{ $centroCosto->CC }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="right-align">Solicitado por:</td>
                            <td>{{ auth()->user()->Nombre }}</td>
                        </tr>
                        <tr>
                            <td class="right-align">Departamento:</td>
                            <td>{{ auth()->user()->Departamento }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container"><div class="inner-div2 container"><h4>Señores</h4><br></div></div>
        <div class ="container">

            <div class="inner-div2 container">

                <div class="inner-div4 container">

                    <table class="custom-table">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="right-align">RUT</td>
                                <td id="Rut"></td>
                            </tr>
                            <tr>
                                <td class="right-align">RAZON SOCIAL</td>
                                <td>
                                    <select id="selectProveedor" name="Proveedor" class="small-select">
                                        <option value="">Selecciona un proveedor</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{ $proveedor->ID }}">{{ $proveedor->RazonSocial }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="right-align">GIRO</td>
                                <td id="Giro"></td>
                            </tr>
                            <tr>
                                <td class="right-align">DIRECCION</td>
                                <td id="Direccion"></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="inner-div3 container">
                    <table class="custom-table">
                        <thead>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="right-align">TELEFONO</td>
                                <td id="Telefono"></td>
                            </tr>
                            <tr>
                                <td class="right-align">MAIL</td>
                                <td id="Mail"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class ="container">
            <div class="inner-div2 container">
                <table>
                    <thead>
                        <tr>
                            <th class="valores">Codigo</th>
                            <th class="valores">Cantidad</th>
                            <th class = "Descripcion">Descripcion</th>
                            <th class="valores">Trabajador (excluyente)</th>
                            <th class="valores">Precio</th>
                            <th class="valores">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="fila_producto">
                            <td id="ID1"></td>
                            <td>
                                <input id="Cantidad1" type="number" class="centrado-sin-bordes" min="1" >
                            </td>
                            <td>
                                <select id="selectProducto1" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador1" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor1" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total1" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID2"></td>
                            <td><input id="Cantidad2" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto2" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador2" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor2" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total2" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID3"></td>
                            <td><input id="Cantidad3" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto3" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador3" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor3" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total3" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID4"></td>
                            <td><input id="Cantidad4" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto4" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador4" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor4" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total4" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID5"></td>
                            <td><input id="Cantidad5" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto5" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador5" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor5" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total5" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID6"></td>
                            <td><input id="Cantidad6" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto6" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador6" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor6" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total6" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID7"></td>
                            <td><input id="Cantidad7" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto7" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador7" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor7" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total7" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID8"></td>
                            <td><input id="Cantidad8" type="number" class="centrado-sin-bordes" min="1" ></td>
                            <td>
                                <select id="selectProducto8" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador8" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor8" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total8" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr id="fila_producto">
                            <td id="ID9"></td>
                            <td>
                                <input id="Cantidad9" type="number" class="centrado-sin-bordes" min="1" >
                            </td>
                            <td>
                                <select id="selectProducto9" name="Producto" class="small-select2">
                                    <option value="">-</option>
                                </select>
                            </td>
                            <td><input id="Trabajador9" type="text" class="centrado-sin-bordes"></td>
                            <td><input id="Valor9" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="Total9" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Total Precios</th>
                            <th>Total</th>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input readonly id="TotalPrecios" type="text" class="centrado-sin-bordes"></td>
                            <td><input readonly id="TotalValores" type="text" class="centrado-sin-bordes"></td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </div>
        Información Adicional
        <textarea class="full-width" name="" id="" cols="30" rows="10"></textarea>
    <div class ="container centrar">
        <div class="inner-div">
            <br>
            FIRMA ____________________
            <br>      V°B° OPERACIONES       <br>

        </div>
        <div class="inner-div2">
            <br>
            FIRMA ____________________
            <br>       V°B° GERENCIA       <br>
        </div>
    </div>
</div>

<div class="button-container">
    <div id="Desaparece">Este boton realizara la transformación de los formatos numeros a valor CLP, presionar al momento de completar la solicitud</div><br>
    <button id="crearNDocBtn" class="button" onclick="sumarInputs()">Crear Número de Documento</button>
</div>
<div class="button-container">
    <button onclick="convertirDivAPDF()" class="button">Descargar</button>
</div>


</body>
</html>

<style>
    .full-width {
        width: 90%;
        box-sizing: border-box; /* Esto asegura que el ancho incluya el padding */
    }
    .order-container {
    width: auto;
    margin: 20px auto;
    border: 1px solid #dddddd;
    border-radius: 5px;
    padding: 20px;
    font-size: 20px; /* Ajustar el tamaño del texto según sea necesario */
    }
    #resultado {
    text-align: left;
    }
    .centrado-sin-bordes {
    width: 100%;
    text-align: center;
    border: none;
    }
    .custom-table {
    border-collapse: collapse;
    }

    .custom-table td {
        border: none;
        padding: 5px;
        width: auto;
        height: auto;
    }
    .right-align {
    text-align: right;

    }
    .small-select {
    width: 300px;
    padding: 5px;
    height: 35px;
    border: none;
    font-size: 20px;    background-color: transparent;
    }
    .small-select2 {
    width: 100%; /* El ancho se ajustará al 100% del contenedor */
    padding: 5px;
    border: none;
    font-size: 20px;

    background-color: transparent;
    }
    .button {
    background-color: #4957d1; /* Color de fondo */
    border: none; /* Sin borde */
    color: white; /* Color del texto */
    padding: 15px 32px; /* Espacio alrededor del texto */
    text-align: center; /* Alineación del texto */
    text-decoration: none; /* Sin subrayado */
    display: inline-block; /* Hacer que el botón sea un bloque en línea */
    font-size: 16px; /* Tamaño del texto */
    margin: 4px 2px; /* Margen exterior */
    cursor: pointer; /* Cambiar el cursor al pasar el ratón */
    border-radius: 8px; /* Borde redondeado */

    }
    .button-container {
        text-align: center; /* Centrar horizontalmente el contenido */
        margin-top: 20px; /* Espacio superior */
    }

    .centrar{
        text-align: center;
    }
    .orden{
        text-align: right;
    }
    .container {
        display: flex; /* Utiliza flexbox */
    }
    /* Estilos para los divs internos */
    .inner-div {
        flex: 1; /* Toma el mismo espacio dentro del contenedor */
        padding: 10px; /* Espacio entre los divs */
        border: 1px solid #ccc; /* Borde para visualización */
        margin-right: 10px; /* Espacio entre los divs */
    }
    .inner-div2 {
        flex: 1; /* Toma el mismo espacio dentro del contenedor */
        padding: 10px; /* Espacio entre los divs */
        border: 1px solid #ccc; /* Borde para visualización */
        margin-right: 10px; /* Espacio entre los divs */
    }
    .inner-div3 {
        flex: 1; /* Toma el mismo espacio dentro del contenedor */
        padding: 10px; /* Espacio entre los divs */

        margin-right: 10px; /* Espacio entre los divs */
        text-align: right;
    }
    .inner-div4 {
        flex: 1; /* Toma el mismo espacio dentro del contenedor */
        padding: 10px; /* Espacio entre los divs */

        margin-right: 10px; /* Espacio entre los divs */
    }
    /* Estilos para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
    }
    .valores{
        width: 100px
    }

    th, td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    min-width: auto; /* Restablecer el ancho mínimo */
    word-wrap: break-word; /* Permitir que el texto se divida en varias líneas */
    height: auto; /* Permitir que la altura se ajuste automáticamente según el contenido de texto */
    }

    th {
        background-color: #f2f2f2;
    }


    .order-header {
        font-size: 20px;
        margin-bottom: 10px;
    }
</style>

<script>
    function convertirDivAPDF() {
        // Selecciona el div que deseas convertir en un PDF
        var divToCapture = document.getElementById('imprimir');

        // Utiliza html2canvas para capturar el contenido del div y convertirlo en una imagen
        html2canvas(divToCapture).then(function(canvas) {
            // Crea una nueva instancia de jsPDF
            var pdf = new jsPDF('p', 'mm', 'a4');

            // Obtiene la imagen generada por html2canvas como datos de imagen
            var imgData = canvas.toDataURL('image/png');

            // Calcula el ancho y el alto del PDF para ajustar la imagen proporcionalmente
            var pdfWidth = pdf.internal.pageSize.getWidth();
            var pdfHeight = pdf.internal.pageSize.getHeight();
            var imgWidth = canvas.width;
            var imgHeight = canvas.height;
            var ratio = Math.min(pdfWidth / imgWidth, pdfHeight / imgHeight);
            var adjustedWidth = imgWidth * ratio;
            var adjustedHeight = imgHeight * ratio;

            // Calcula la posición central para colocar la imagen en el PDF
            var x = (pdfWidth - adjustedWidth) / 2;
            var y = 10; // Ajusta esta posición para mover el PDF hacia arriba

            // Agrega la imagen al PDF con el tamaño y la posición ajustados
            pdf.addImage(imgData, 'PNG', x, y, adjustedWidth, adjustedHeight);

            // Descarga el PDF
            pdf.save('documento.pdf');
        });
    }

    //Formato a clp
    document.getElementById('crearNDocBtn').addEventListener('click', function() {
        for (let i = 1; i <= 9; i++) {
            let inputId = 'Valor' + i;
            let inputValue = document.getElementById(inputId).value;
            let formattedValue = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(inputValue);
            document.getElementById(inputId).value = formattedValue;
        }
    });
    document.getElementById('crearNDocBtn').addEventListener('click', function() {
        for (let i = 1; i <= 9; i++) {
            let inputId = 'Total' + i;
            let inputValue = document.getElementById(inputId).value;
            let formattedValue = new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(inputValue);
            document.getElementById(inputId).value = formattedValue;
        }
    });
    //SumarInputs
    function sumarInputs() {
        var total = 0;
        for (var i = 1; i <= 9; i++) {
            var inputId = "Valor" + i;
            var input = document.getElementById(inputId);
            if (input) {
                var valor = parseFloat(input.value) || 0;
                total += valor;
            }
        }
        document.getElementById("TotalPrecios").value = total;

        var total2 = 0;
        for (var i = 1; i <= 9; i++) {
            var inputId = "Total" + i;
            var input = document.getElementById(inputId);
            if (input) {
                var valor = parseFloat(input.value) || 0;
                total2 += valor;
            }
        }
        document.getElementById("TotalValores").value = total2;
            // Obtener los valores de los inputs
        var totalValores = parseFloat(document.getElementById("TotalValores").value) || 0;
        var totalPrecios = parseFloat(document.getElementById("TotalPrecios").value) || 0;

        // Realizar la conversión a formato CLP
        var totalValoresCLP = totalValores.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' });
        var totalPreciosCLP = totalPrecios.toLocaleString('es-CL', { style: 'currency', currency: 'CLP' });

        // Actualizar los valores de los inputs con el formato CLP
        document.getElementById("TotalValores").value = totalValoresCLP;
        document.getElementById("TotalPrecios").value = totalPreciosCLP;
        var boton = document.getElementById("crearNDocBtn");
        if (boton) {
            boton.style.display = "none";
        }
        var boton = document.getElementById("Desaparece");
        if (boton) {
            boton.style.display = "none";
        }
    }

    //Crear numero documento
    $(document).ready(function() {
            $('#crearNDocBtn').click(function() {
                $.ajax({
                    type: "GET",
                    url: "/crear-ndoc",
                    success: function(data) {
                        // Mostrar el resultado en el div "resultado"
                        $('#resultado').html('<p> SDC-N°-' + data.id + '</p>');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

    //Seleccionar proveedor y se llene automaticamente
    document.addEventListener('DOMContentLoaded', function() {
        var selectProveedor = document.getElementById('selectProveedor');
        var tdRut = document.getElementById('Rut');
        var tdGiro = document.getElementById('Giro');
        var tdDireccion = document.getElementById('Direccion');
        var tdMail = document.getElementById('Mail');
        var tdTelefono = document.getElementById('Telefono');

        selectProveedor.addEventListener('change', function() {
            var proveedorId = this.value;
            if (proveedorId !== "") {
                axios.get('/obtenerProveedorInfo/' + proveedorId)
                    .then(function(response) {
                        var proveedorInfo = response.data;
                        tdRut.textContent = proveedorInfo.Rut;
                        tdGiro.textContent = proveedorInfo.Giro;
                        tdDireccion.textContent = proveedorInfo.Direccion;
                        tdMail.textContent = proveedorInfo.Mail;
                        tdTelefono.textContent = proveedorInfo.Telefono;
                        // Puedes agregar más campos aquí según sea necesario
                    })
                    .catch(function(error) {
                        console.error('Error al obtener la información del proveedor', error);
                    });
            } else {
                // Limpiar los campos si no se ha seleccionado ningún proveedor
                tdRut.textContent = "";
                tdGiro.textContent = "";
                tdDireccion.textContent = "";
                tdMail.textContent = "";
                tdTelefono.textContent = "";
                // Puedes limpiar más campos aquí según sea necesario
            }
        });
    });
    //Lenar select de filas de productos
    $(document).ready(function() {
        $('#selectProveedor').change(function() {
            var proveedorId = $(this).val();
            if (proveedorId) {
                // Vaciar todos los selectProducto
                $('[id^=selectProducto]').empty().append('<option value="">-</option>');

                $.ajax({
                    type: "GET",
                    url: "/productos-por-proveedor/" + proveedorId,
                    success: function(data) {
                        // Actualizar las opciones de todos los selectProducto
                        $('[id^=selectProducto]').each(function() {
                            var select = $(this);
                            $.each(data, function(key, value) {
                                select.append('<option value="' + value.ID + '">' + value.Descripcion + '</option>');
                            });
                        });
                    }
                });
            } else {
                // Si no hay proveedor seleccionado, vaciar todos los selectProducto
                $('[id^=selectProducto]').empty().append('<option value="">-</option>');
            }
        });
    });

    //Fila
    $(document).ready(function() {
        // Fila 9
        $('#selectProducto9').change(function() {
            updateProductDetails(9);
        });

        $('#Cantidad9').on('input', function() {
            calculateTotal(9);
        });

        // Fila 8
        $('#selectProducto8').change(function() {
            updateProductDetails(8);
        });

        $('#Cantidad8').on('input', function() {
            calculateTotal(8);
        });

        // Fila 7
        $('#selectProducto7').change(function() {
            updateProductDetails(7);
        });

        $('#Cantidad7').on('input', function() {
            calculateTotal(7);
        });

        // Fila 6
        $('#selectProducto6').change(function() {
            updateProductDetails(6);
        });

        $('#Cantidad6').on('input', function() {
            calculateTotal(6);
        });

        // Fila 5
        $('#selectProducto5').change(function() {
            updateProductDetails(5);
        });

        $('#Cantidad5').on('input', function() {
            calculateTotal(5);
        });

        // Fila 4
        $('#selectProducto4').change(function() {
            updateProductDetails(4);
        });

        $('#Cantidad4').on('input', function() {
            calculateTotal(4);
        });

        // Fila 3
        $('#selectProducto3').change(function() {
            updateProductDetails(3);
        });

        $('#Cantidad3').on('input', function() {
            calculateTotal(3);
        });

        // Fila 2
        $('#selectProducto2').change(function() {
            updateProductDetails(2);
        });

        $('#Cantidad2').on('input', function() {
            calculateTotal(2);
        });

        // Fila 1
        $('#selectProducto1').change(function() {
            updateProductDetails(1);
        });

        $('#Cantidad1').on('input', function() {
            calculateTotal(1);
        });

        // Función para actualizar los detalles del producto
        function updateProductDetails(row) {
            var selectId = '#selectProducto' + row;
            var idField = '#ID' + row;
            var cantidadField = '#Cantidad' + row;
            var trabajadorField = '#Trabajador' + row;
            var valorField = '#Valor' + row;
            var totalField = '#Total' + row;

            var productoId = $(selectId).val();
            if (productoId) {
                // Realizar una solicitud AJAX para obtener los detalles del producto
                $.ajax({
                    type: "GET",
                    url: "/obtener-detalles-producto/" + productoId, // Reemplaza esta URL por la que corresponda en tu aplicación
                    success: function(data) {
                        // Actualizar los campos ID y Valor con los datos del producto
                        $(idField).text(data.ID);
                        $(valorField).val(data.Valor);
                        // También podrías actualizar otros campos si es necesario, como trabajadorField, etc.
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                // Vaciar todos los campos si no se ha seleccionado un producto
                $(idField).text('');
                $(cantidadField).val('');
                $(trabajadorField).val('');
                $(valorField).val('');
                $(totalField).val('');
            }
        }

        // Función para calcular el total
        function calculateTotal(row) {
            var cantidadField = '#Cantidad' + row;
            var valorField = '#Valor' + row;
            var totalField = '#Total' + row;

            var cantidad = $(cantidadField).val();
            var valor = $(valorField).val();

            // Validar si tanto la cantidad como el valor son números válidos
            if ($.isNumeric(cantidad) && $.isNumeric(valor)) {
                // Calcular el total multiplicando la cantidad por el valor
                var total = parseFloat(cantidad) * parseFloat(valor);

                // Mostrar el total en el campo correspondiente
                $(totalField).val(total); // Redondear el total a 2 decimales
            } else {
                // Si alguno de los valores no es numérico, mostrar un mensaje de error o limpiar el campo de total
                $(totalField).val('');
            }
        }
    });


</script>
