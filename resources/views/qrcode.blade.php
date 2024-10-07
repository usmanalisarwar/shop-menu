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
            flex-direction: column;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        div {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
<h1>Scan the QR Code to Open the {{$menu->title}} menu!</h1>
<div>
    {!! $qrCode !!}
</div>
</body>
</html>
