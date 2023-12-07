<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="icon" href="images/favicon.ico"/>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
        <title>Collections | Keep track of your collections</title>
    </head>
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="{{ route('collections.index') }}">
                <img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo"/>
            </a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                    <li>
                        <a href="{{ route('users.edit') }}" class="hover:text-red-500">
                            <i class="fa-solid fa-user"></i> Profile
                        </a>
                    </li>
                    <li>
                        <form class="inline" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Logout
                            </button>
                        </form>
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('users.create') }}" class="hover:text-red-500">
                            <i class="fa-solid fa-user-plus"></i> Register
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="hover:text-red-500">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
        <main>
            @yield('content')
        </main>
        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-red-500 text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; {{ now()->format('Y') }}, All Rights reserved</p>

            <a
                href="{{ route('collections.create') }}"
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
            >
                Create Collection
            </a>
        </footer>

        <x-flash-message />
    </body>
</html>
