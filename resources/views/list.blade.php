
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Within 100km of Dublin office - Affiliates">
    <meta name="keywords" content="Dublin office, affiliates, distance">
    <title>Within 100km of Dublin Office - Affiliates</title>
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto pt-5 py-4">
        <h1 class="text-2xl font-bold mb-4">Affiliates within 100km of Dublin Office</h1>

        <table class="w-full bg-white border-2 border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Affiliate ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Latitude</th>
                    <th class="py-2 px-4 border-b">Longitude</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sortedLocations as $key => $item)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $item['affiliate_id'] }}</td>
                        <td class="py-2 px-4 border-b">{{ $item['name'] }}</td>
                        <td class="py-2 px-4 border-b">{{ $item['latitude'] }}</td>
                        <td class="py-2 px-4 border-b">{{ $item['longitude'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white border container mx-auto pt-5 pb-4">
        <div class="p-5">
            <h2 class="text-2xl font-bold mb-4">Files Touched</h2>
            <ul class="list-disc pl-5">
                <li class="mb-2">app/Http/Controllers/CoordinateController.php</li>
                <li class="mb-2">tests/Unit/CoordinateControllerTest.php</li>
                <li class="mb-2">routes/web.php</li>
                <li class="mb-2">resources/views/list.blade.php</li>
            </ul>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
