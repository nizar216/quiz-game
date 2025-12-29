<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Quiz Game') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-sm border-b">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center gap-8">
            <a href="{{ route('judge.dashboard') }}" class="text-2xl font-bold text-blue-600">
                Quiz Game
            </a>
            <div class="hidden md:flex gap-6">
                <a href="{{ route('judge.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                    Dashboard
                </a>
                <a href="{{ route('games.create') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                    New Game
                </a>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-700"
                onclick="document.getElementById('mobile-menu').toggleAttribute('hidden')">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" hidden class="md:hidden bg-gray-50 border-t p-4">
        <a href="{{ route('judge.dashboard') }}" class="block py-2 text-gray-700 hover:text-blue-600">Dashboard</a>
        <a href="{{ route('games.create') }}" class="block py-2 text-gray-700 hover:text-blue-600">New Game</a>
    </div>
</nav>

<!-- Main Content -->
<main>
    {{ $slot }}
</main>

<!-- Footer -->
<footer class="bg-white border-t mt-12">
    <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-600 text-sm">
        <p>&copy; {{ date('Y') }} Quiz Game. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
