<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu PDF</title>
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
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .menu {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            page-break-after: always;
        }
        .menu:last-child {
            page-break-after: avoid;
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
            height: auto;
            object-fit: cover;
            margin: 0;
        }
        .user-info {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="menu">
        <h1>Title:{{ $menu->title }}</h1>

        <!-- User Information -->
        <div class="user-info">
            <p>Name: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Company: {{ $user->company_name }}</p> 
        </div>

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
