<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-blue-200 py-3 px-3">
    <div class="bg-gray-900 text-white navigation">
        <nav class="container mx-auto flex justify-center py-4">
            <div class="flex items-center">
                <a href="{{ route('home') }}">
                    <input type='button' value='Volver a Home'
                        class='bg-blue-700 text-white px-4 py-2 m-3 rounded hover:bg-blue-500 my-2'>
                </a>
            </div>
            <div class="flex justify-center">
                <section>
                    <a href="{{ route('purchases.index') }}">
                        <input type='button' value='Listado de Compras'
                            class='bg-yellow-700 text-white px-4 py-2 m-3 rounded hover:bg-yellow-500 my-2'>
                    </a>
                </section>
                <section>
                    <a href="{{ route('products.index') }}">
                        <input type='button' value='Listado de Productos'
                            class='bg-lime-800	text-white px-4 py-2 m-3 rounded hover:bg-blue-500 my-2'>
                    </a>
                </section>
        </nav>
    </div>
    @yield('content')

</body>

</html>
