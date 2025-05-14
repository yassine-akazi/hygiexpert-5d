<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <script type="module">
  import { createIcons } from 'https://unpkg.com/lucide@latest?module'
  createIcons()
</script>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    @yield('navbar')

    <div class="flex">
        @yield('sidebar')

        <main class="flex-1 p-6 mt-20 ml-64 text-black  " >
            @yield('content')
        </main>
    </div>
    <!-- Add this to the head section -->

</body>
</html>