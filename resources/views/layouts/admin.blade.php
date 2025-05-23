<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.x.x/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
<script>
  // Initialisation du thème au chargement
  if (
    localStorage.getItem('theme') === 'dark' ||
    (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
  ) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }

  // Bouton de bascule
  document.getElementById('toggleDarkMode').addEventListener('click', () => {
    const html = document.documentElement;
    html.classList.toggle('dark');

    const isDark = html.classList.contains('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');

    // Mise à jour manuelle (facultatif car Tailwind gère avec `dark:`)
    document.getElementById('icon-sun').classList.toggle('hidden', isDark);
    document.getElementById('icon-moon').classList.toggle('hidden', !isDark);
  });
</script>
</html>