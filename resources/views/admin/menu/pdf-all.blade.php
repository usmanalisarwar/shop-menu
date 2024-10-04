<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Menus PDF</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center vertically */
            align-items: center; /* Center horizontally */
            height: 100vh;
            text-align: center;
        }
        .menu {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center the content vertically */
            align-items: center; /* Center the content horizontally */
            page-break-after: always;
        }
        .menu:last-child {
            page-break-after: avoid;
        }
        .image-container {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

</head>
<body>
    <div class="header">
        <p>User: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <p>Company: {{ $user->company_name }}</p>
    </div>

    @foreach ($menus as $menu)
        <div class="menu">
            <h2 style="text-align: center;">{{ $menu->title }}</h2>
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
    @endforeach
</body>
</html>
