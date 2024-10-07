<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipbook PDF</title>
    <!-- Include DearFlip CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dearflip/dist/css/dflip.min.css" type="text/css" />
</head>
<body>
<div style="width: 100%; height: 600px;">
    <div id="flipbook" class="dflip"></div>
</div>

<!-- Include DearFlip JS -->
<script src="https://cdn.jsdelivr.net/npm/dearflip/dist/js/dflip.min.js"></script>

<script>
    // Initialize the flipbook
    var flipbook = new DFLIP({
        pdf: {{$file}}, // Path to your PDF file
        webgl: false // Optional, set true for 3D flipbook
    });
    // Attach the flipbook to the element
    flipbook.attachTo("#flipbook");
</script>
</body>
</html>
