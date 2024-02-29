<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')

</head>

<body class="bg-blue-200 py-3 px-3">
    <nav class="flex items-center justify-between flex-wrap bg-gray-900 p-6">
        <div class="block lg:hidden">
            <button id="burguerMenu"
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400  hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div id="botonesMenu" class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden text-center">
            <div class="text-sm lg:flex-grow">
                <a href="{{ route('home') }}"
                    class="block mt-4 lg:inline-block lg:mt-0 text-teal-200  mr-4 text-xl font-bold hover:underline hover:text-yellow-500">Volver a Home
                </a>
                <a href="{{ route('purchases.index') }}"
                    class="block mt-4 lg:inline-block lg:mt-0 text-teal-200  mr-4 text-xl font-bold hover:underline hover:text-yellow-500">
                    Listado de Compras
                </a>
                <a href="{{ route('products.index') }}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-200  text-xl font-bold hover:underline hover:text-yellow-500">
                    Listado de Productos
                </a>
            </div>
        </div>
    </nav>
    {{-- <div class="bg-gray-900 text-white navigation">
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
    </div> --}}
    @yield('content')
    @vite('resources/js/app.js')

</body>

</html>
