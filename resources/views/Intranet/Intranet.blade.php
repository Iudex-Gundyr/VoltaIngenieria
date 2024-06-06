<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/Logo.png') }}">
    <title>Intranet</title>
</head>
<body>
    @include('Intranet/Navbar')
    @if(session('error'))
        <div class="alert alert-danger" style="background: red">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>
