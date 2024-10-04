<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu PDF</title>
    <style>
        /* Ensure A4 size layout */
        @page {
            size: A4;
            margin: 0; /* Remove default margins */
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        h1 {
            text-align: center;
            margin-bottom: 40px;
        }
        .menu {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            page-break-after: always; /* Add a page break after each menu */
        }
        .menu:last-child {
            page-break-after: avoid; /* Avoid breaking after the last menu */
        }
        .image-container {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the image fills the entire container */
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="menu">
        @if ($menu->images->isNotEmpty())
            <div class="image-container">
                @foreach ($menu->images as $index => $image)
                    @php
                        $imagePath = public_path('uploads/menu/' . $image->image);
                        $base64 = base64_encode(file_get_contents($imagePath));
                        $imageSrc = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . $base64;
                    @endphp
                    <img src="{{ $imageSrc }}" class="image" alt="Image {{ $index + 1 }}">
                @endforeach
            </div>
        @else
            <p>No images available for this menu.</p>
        @endif
    </div>
</body>
</html>
