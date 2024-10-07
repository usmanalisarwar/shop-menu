<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Shop Menu</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">


    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('dflip/css/dflip.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Icons Stylesheet -->
    <link href="{{ asset('dflip/css/themify-icons.min.css')}}" rel="stylesheet" type="text/css">

</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-xs-12">
            <h2>{{$menu->title}} </h2>
        </div>
        <div class="col-xs-12" style="padding-bottom:30px">
            <!--Normal FLipbook-->
            <div class="_df_book" height="500" webgl="true" backgroundcolor="teal"
                 source="{{$file}}"
                 id="df_manual_book">
            </div>

        </div>
    </div>
</div>

<!-- jQuery  -->
<script src="{{ asset('dflip/js/libs/jquery.min.js')}}" type="text/javascript"></script>
<!-- Flipbook main Js file -->
<script src="{{ asset('dflip/js/dflip.min.js')}}" type="text/javascript"></script>

</body>
</html>
