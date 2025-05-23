<!DOCTYPE html>
<html lang="fr" 
  x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
  :class="{ 'dark': darkMode }" 
  x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value))"
>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Mes fichiers PDF - {{ $client->nom }} {{ $client->prenom }}</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' };
  </script>

  <!-- Alpine.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <style>
    html { transition: background-color 0.3s, color 0.3s; }
  </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
<nav class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 shadow-sm flex justify-between items-center">
  <div class="flex items-center gap-3">
    <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Logo" />

  </div>

  <div class="flex items-center gap-4">
  <a href="{{ route('client.login.form') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition" > Mes fichiers </a>

  <a href="{{ route('client.infos') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition">Mes informations</a>
  <a href="{{ route('client.contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition">Contactez-nous</a>
    <!-- Toggle Dark Mode -->
    <button @click="darkMode = !darkMode" class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Toggle dark mode">
  <template x-if="!darkMode">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun-icon lucide-sun text-gray-900 dark:text-white"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
  </template>
  <template x-if="darkMode">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon-star-icon lucide-moon-star text-gray-900 dark:text-white"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9"/><path d="M20 3v4"/><path d="M22 5h-4"/></svg>
  </template>
</button>

<span class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-icon lucide-user text-gray-900 dark:text-white"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
  {{ $client->nom }} {{ $client->prenom }}  / {{ $client->nom_entreprise }}  
</span>

    <form method="POST" action="{{ route('client.logout') }}">
      @csrf
      <button type="submit" class="ml-4 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow transition focus:outline-none">Déconnexion</button>
    </form>
  </div>
</nav>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-8 text-indigo-600 dark:text-indigo-400">Mes informations</h1>

    @php
    use Illuminate\Support\Str;

    $iconMap = [
        'Nom' => 'user',
        'Prénom' => 'user',
        'Fonction' => 'briefcase',
        'Nom entreprise' => 'building',
        'ICE' => 'badge-dollar-sign',
        'Téléphone' => 'phone',
        'Email' => 'mail',
        'Adresse' => 'map-pin',
    ];

    $fields = [
        'Nom' => $client->nom,
        'Prénom' => $client->prenom,
        'Fonction' => $client->fonction,
        'Nom entreprise' => $client->nom_entreprise,
        'ICE' => $client->ice,
        'Téléphone' => $client->phone,
        'Email' => $client->email,
        'Adresse' => $client->adresse,
    ];
@endphp

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-extrabold mb-8 text-indigo-600 dark:text-indigo-400 flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info-icon lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        Mes informations
    </h1>

    <div class="overflow-hidden rounded-xl shadow-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach ($fields as $label => $value)
                    <tr class="hover:bg-indigo-50 dark:hover:bg-indigo-900 transition-all duration-200 group">
                        <td class="flex items-center gap-3 px-6 py-4 w-1/3 font-medium text-gray-700 dark:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5 text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-200"
                                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <use xlink:href="#{{ $iconMap[$label] ?? 'info' }}" />
                            </svg>
                            {{ $label }}
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Inline SVG icons using Lucide --}}
<svg style="display: none;">
    <symbol id="user" viewBox="0 0 24 24"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></symbol>
    <symbol id="briefcase" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 3h-8v4h8V3z"/></symbol>
    <symbol id="building" viewBox="0 0 24 24"><path d="M3 21V7a2 2 0 0 1 2-2h2V3h10v2h2a2 2 0 0 1 2 2v14"/><path d="M9 21v-6h6v6"/><path d="M9 3v2"/><path d="M15 3v2"/></symbol>
    <symbol id="badge-dollar-sign" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v8"/><path d="M9 11h6"/><path d="M9 13h6"/></symbol>
    <symbol id="phone" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.08 4.18 2 2 0 0 1 4.06 2h3a2 2 0 0 1 2 1.72c.14 1.22.45 2.4.93 3.53a2 2 0 0 1-.45 2.11L8.09 10.91a16 16 0 0 0 6 6l1.55-1.55a2 2 0 0 1 2.11-.45 16.16 16.16 0 0 0 3.53.93A2 2 0 0 1 22 16.92z"/></symbol>
    <symbol id="mail" viewBox="0 0 24 24"><path d="M4 4h16v16H4z"/><path d="M22 6 12 13 2 6"/></symbol>
    <symbol id="map-pin" viewBox="0 0 24 24"><path d="M12 21s-6-5.686-6-10a6 6 0 0 1 12 0c0 4.314-6 10-6 10Z"/><circle cx="12" cy="11" r="2"/></symbol>
</svg>
</div>
</body>
</html>