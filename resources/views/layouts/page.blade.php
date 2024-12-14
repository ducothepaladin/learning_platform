<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sato Land</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    @vite('resources/css/app.css')
</head>
<body class="relative w-lvw h-lvh overflow-x-hidden">
    <header class="fixed w-full bg-tulip-tree-50 border-b z-10 top-0 left-0">
        <nav class="flex container mx-auto justify-between p-5">
            <div>
                <h1 class="font-bold text-3xl">Duco Land</h1>
            </div>
            <div>
                @if (Auth::check())
                <a class="text-lg px-4 py-3 bg-cod-gray-950 text-tulip-tree-400 rounded-full me-3" href="/space">Library</a>
                <a class="px-4 py-3 bg-tulip-tree-950 rounded-full text-gray-nurse-100" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
             </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
             </form>
                @else
                <ul class="flex gap-4">
                    <li><a href="{{ route('login') }}" class="px-4 py-3">Login</a></li>
                    <li><a href="{{ route('register') }}" class="px-4 py-3 rounded-full bg-cod-gray-950 text-slate-200">Register</a></li>
                </ul>
                @endif
            </div>
        </nav>
    </header>
    <mai class="p-3">
        @yield('pages')
    </main>
</body>
</html>
