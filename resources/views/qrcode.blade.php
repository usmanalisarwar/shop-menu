<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Menu</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .container {
            position: relative;
        }
        .qr-container {
            position: absolute;
            top: 50%;
            left: -20%; /* Moves QR code 50% left from the image */
            transform: translate(0, -50%); /* Centers the QR code vertically */
        }
        .qr-container img {
            width: 100%;
            height: auto;
        }
        .menu-image {
            height: 700px;
            width: 500px;
        }
    </style>
</head>
<body>
<div class="container">
    <img src="{{ asset('temp/' . $menuImage->name) }}" class="menu-image" alt="Menu Image">
    <div class="qr-container">
        {!! $qrCode !!}
    </div>
</div>
</body>
</html>
