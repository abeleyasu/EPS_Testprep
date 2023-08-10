<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('mail-head')
</head>
<body style="font-weight: 500; font-size: 17px;">
    <h2>Dear {{ $name }}</h2>
    @yield('mail-content')
</body>
</html>