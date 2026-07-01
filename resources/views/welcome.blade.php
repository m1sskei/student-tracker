<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Task Tracker</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-pink-50 text-gray-800 font-[Inter] min-h-screen flex flex-col justify-between">
        
        <header class="w-full bg-white shadow-sm border-b border-pink-200 py-4 px-6 md:px-12 flex justify-between items-center">
            <div class="text-2xl font-extrabold text-pink-800 tracking-tight">
                TaskTracker<span class="text-pink-400">.</span>
            </div>
            <nav class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-pink-700 hover:text-pink-900 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-pink-700 transition">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm font-semibold bg-pink-700 text-white px-5 py-2 rounded-md hover:bg-pink-800 transition shadow-sm">Signup</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <main class="flex-grow flex items-center justify-center p-6">
            <div class="max-w-4xl text-center bg-white p-10 md:p-16 rounded-2xl shadow-xl border border-pink-100">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    Manage Your Academic Life, <br />
                    <span class="text-pink-700">Elegantly.</span>
                </h1>
                
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    A streamlined, professional workspace designed for students. Organize your priorities, track deadlines, and maintain focus with our minimal task management system.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 w-full sm:w-auto bg-pink-700 text-white font-medium rounded-lg hover:bg-pink-800 transition shadow-md">
                                Access Workspace
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-8 py-3 w-full sm:w-auto bg-pink-700 text-white font-medium rounded-lg hover:bg-pink-800 transition shadow-md">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-8 py-3 w-full sm:w-auto bg-white text-pink-700 font-medium rounded-lg border border-pink-300 hover:bg-pink-50 transition shadow-sm">
                                    Signup
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </main>

        <footer class="w-full text-center py-6 text-sm text-gray-500 bg-white border-t border-pink-200 font-medium">
            &copy; {{ date('Y') }} Student Task Tracker. Developed by Kei Agulto.
        </footer>

    </body>
</html>