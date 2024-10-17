<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Shop Menu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('dflip/css/dflip.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Icons Stylesheet -->
    <link href="{{ asset('dflip/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Custom Styles to make Flipbook full-screen -->
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .container {
            height: 100%;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .flipbook-container {
            height: 100%;
            width: 100%;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="flipbook-container">
        <!-- Normal Flipbook -->
        <div class="_df_book" webgl="true" backgroundcolor="teal"
             source="{{$file}}"
             id="df_manual_book">
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="{{ asset('dflip/js/libs/jquery.min.js')}}" type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('dflip/js/dflip.min.js')}}" type="text/javascript"></script>

</body>
</html>
