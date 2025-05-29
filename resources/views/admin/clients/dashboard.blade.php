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
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = { darkMode: 'class' };
  </script>

  <!-- Alpine.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    html { transition: background-color 0.3s, color 0.3s; }
  </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

<nav x-data="{ open: false }"
     class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 shadow-sm flex items-center justify-between">
  
  <!-- Logo -->
  <div class="flex items-center gap-3">
    <img src="{{ asset('images/favicon.png') }}" class="h-10" alt="Logo" />
  </div>

  <!-- Hamburger Button (Mobile) -->

  <button @click="open = !open" class="md:hidden text-gray-700 dark:text-gray-300 focus:outline-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
         stroke="currentColor" stroke-width="2">
      <path x-show="!open" stroke-linecap="round" stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16" />
      <path x-show="open" stroke-linecap="round" stroke-linejoin="round"
            d="M6 18L18 6M6 6l12 12" />
    </svg>
  </button>

  <!-- Full menu (Desktop) -->
  <div class="hidden md:flex items-center gap-4">
    <a href="{{ route('client.login.form') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Mes fichiers</a>
    <a href="{{ route('client.infos') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Mes informations</a>
    <a href="{{ route('client.contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Contactez-nous</a>

    <!-- Dark Mode Toggle -->
    <button @click="darkMode = !darkMode" class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700 transition" aria-label="Toggle dark mode">
      <template x-if="!darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-sun text-gray-900 dark:text-white"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
      </template>
      <template x-if="darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-moon-star text-gray-900 dark:text-white"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9"/><path d="M20 3v4"/><path d="M22 5h-4"/></svg>
      </template>
    </button>

    <!-- Nom utilisateur -->
    <span class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="lucide lucide-user text-gray-900 dark:text-white"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      {{ $client->nom }} {{ $client->prenom }} / {{ $client->nom_entreprise }}
    </span>

    <!-- Déconnexion -->
    <form method="POST" action="{{ route('client.logout') }}">
      @csrf
      <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow">Déconnexion</button>
    </form>
  </div>

  <!-- Mobile menu -->
 
  <div x-show="open" @click.away="open = false" class="absolute top-full left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 shadow-md md:hidden flex flex-col gap-2 p-4">
    <a href="{{ route('client.login.form') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Mes fichiers</a>
    <a href="{{ route('client.infos') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Mes informations</a>
    <a href="{{ route('client.contact') }}" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">Contactez-nous</a>

    <button @click="darkMode = !darkMode" class="block px-4 py-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700">
      
    <template x-if="!darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-sun text-gray-900 dark:text-white"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="m4.93 4.93 1.41 1.41"/><path d="m17.66 17.66 1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="m6.34 17.66-1.41 1.41"/><path d="m19.07 4.93-1.41 1.41"/></svg>
      </template>
      <template x-if="darkMode">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
          class="lucide lucide-moon-star text-gray-900 dark:text-white"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9"/><path d="M20 3v4"/><path d="M22 5h-4"/></svg>
      </template>
    </button>

    <form method="POST" action="{{ route('client.logout') }}">
      @csrf
      <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded">Déconnexion</button>
    </form>
  </div>
</nav>

<main class="p-6 flex-grow pt-20 w-full max-w-7xl mx-auto">

  {{-- Titre principal --}}
  <h2 class="text-3xl font-extrabold mb-8 text-gray-900 dark:text-white">
    Les Documents de <span class="text-indigo-600">{{ $client->nom_entreprise }}</span>
  </h2>

  {{-- Filtre par année --}}
  @if($years->count())
    <div class="mb-6 flex flex-wrap gap-3 overflow-x-auto scrollbar-thin scrollbar-thumb-indigo-400">
      <a href="{{ route('client.dashboard') }}"
         class="px-3 py-2 rounded-full text-sm font-semibold transition
         {{ !$year ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
        Tous
      </a>
      @foreach($years as $y)
        <a href="{{ route('client.dashboard', ['year' => $y]) }}"
           class="px-3 py-2 rounded-full text-sm font-semibold transition
           {{ $year == $y ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
          {{ $y }}
        </a>
      @endforeach
    </div>
  @endif

  {{-- Filtre par mois --}}
  @if($year && $months->count())
    <div class="mb-8 flex flex-wrap gap-3 overflow-x-auto scrollbar-thin scrollbar-thumb-indigo-400">
      @foreach($months as $m)
        <a href="{{ route('client.dashboard', ['year' => $year, 'month' => $m]) }}"
           class="px-3 py-1 rounded-full text-sm font-medium transition whitespace-nowrap
           {{ ($month == $m) ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
          {{ \Carbon\Carbon::create()->month((int)$m)->locale('fr_FR')->isoFormat('MMMM') }}
        </a>
      @endforeach
    </div>
  @endif

  <div class="flex flex-col md:flex-row gap-6">

    {{-- Types de documents --}}
    <div class="md:w-1/4 w-full bg-gray-100 dark:bg-gray-800 rounded p-4 shadow max-h-[300px] md:max-h-none overflow-auto">
      <h3 class="font-bold mb-4 text-gray-700 dark:text-gray-200">Types de documents</h3>
      <ul id="typeList" class="space-y-2">
        <li>
          <button data-type="all" class="type-btn px-3 py-1 rounded bg-indigo-600 text-white font-semibold w-full text-left dark:text-gray-200">
            Tous
          </button>
        </li>
        @foreach ($documentsGrouped as $type => $docs)
          <li>
            <button data-type="{{ $type }}" class="type-btn px-3 py-1 rounded hover:bg-indigo-600 hover:text-white w-full text-left text-gray-700 dark:text-gray-300">
              {{ $labels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }} ({{ $docs->count() }})
            </button>
          </li>
        @endforeach
      </ul>
    </div>

    {{-- Liste des fichiers --}}
    <div class="md:w-3/4 w-full bg-white dark:bg-gray-900 rounded shadow p-6 overflow-auto max-h-[500px] md:max-h-[600px]">
      @if($documentsGrouped->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 text-lg font-medium">
          Aucun fichier trouvé.
        </div>
      @else
      <form id="download-form" method="POST" action="{{ route('client.documents.downloadZip') }}">
      @csrf
      <div class="flex flex-col sm:flex-row items-start sm:items-center mb-6 gap-3">
        <div class="flex items-center">
          <input type="checkbox" id="select-all-global" class="form-checkbox h-6 w-6 text-indigo-600" />
          <label for="select-all-global" class="ml-2 font-semibold cursor-pointer">Sélectionner tous les fichiers</label>
        </div>
        <button id="btnDownloadZip" type="button" class="ml-auto flex items-center px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Télécharger ZIP
        </button>
      </div>

      @foreach ($documentsGrouped as $type => $docs)
        <div class="files-group mb-6" data-type="{{ $type }}">
          <h3 class="text-lg font-semibold mb-3">{{ $labels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}</h3>
          @foreach ($docs as $doc) 
          <div class="mb-2 flex flex-col sm:flex-row sm:items-center bg-gray-50 dark:bg-gray-800 p-3 rounded shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
            <label for="doc_{{ $doc->id }}" class="flex items-center flex-1 cursor-pointer">
              <input type="checkbox" id="doc_{{ $doc->id }}" name="documents[]" value="{{ asset('storage/' . $doc->path) }}" class="form-checkbox h-5 w-5" />
              <span class="ml-3 truncate max-w-[200px] sm:max-w-full">{{ basename($doc->path) }}</span>
            </label>

            <div class="flex gap-4 mt-2 sm:mt-0 sm:ml-4">
              <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="text-blue-600" title="Voir le PDF" aria-label="Voir le PDF">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
              </a>

              <a href="{{ asset('storage/' . $doc->path) }}" download class="text-green-600" title="Télécharger" aria-label="Télécharger">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg>
              </a>
            </div>
          </div>
          @endforeach
        </div>
      @endforeach
      </form>
      @endif
    </div>

  </div>
</main>

<div class="fixed bottom-6 right-6 flex flex-col items-end space-y-4 z-50">
  <!-- Bouton Help You au-dessus -->
  <a href="https://wa.me/212677864237" 
     class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-md hover:bg-indigo-700 transition text-sm font-semibold  h-auto"
     aria-label="Assistance">
     Besoin d’aide ?
  </a>

  <!-- Bouton WhatsApp avec SVG plus petit -->
  <a href="https://wa.me/212677864237" target="_blank" rel="noopener noreferrer" 
     class="p-3 bg-green-500 rounded-full shadow-lg hover:bg-green-600 transition"
     aria-label="Contact WhatsApp">
     <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48" class="w-8 h-8    ">
<path fill="#fff" d="M4.9,43.3l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5c5.1,0,9.8,2,13.4,5.6C41,14.2,43,18.9,43,24	c0,10.5-8.5,19-19,19c0,0,0,0,0,0h0c-3.2,0-6.3-0.8-9.1-2.3L4.9,43.3z"></path><path fill="#fff" d="M4.9,43.8c-0.1,0-0.3-0.1-0.4-0.1c-0.1-0.1-0.2-0.3-0.1-0.5L7,33.5c-1.6-2.9-2.5-6.2-2.5-9.6	C4.5,13.2,13.3,4.5,24,4.5c5.2,0,10.1,2,13.8,5.7c3.7,3.7,5.7,8.6,5.7,13.8c0,10.7-8.7,19.5-19.5,19.5c-3.2,0-6.3-0.8-9.1-2.3	L5,43.8C5,43.8,4.9,43.8,4.9,43.8z"></path><path fill="#cfd8dc" d="M24,5c5.1,0,9.8,2,13.4,5.6C41,14.2,43,18.9,43,24c0,10.5-8.5,19-19,19h0c-3.2,0-6.3-0.8-9.1-2.3L4.9,43.3	l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5 M24,43L24,43L24,43 M24,43L24,43L24,43 M24,4L24,4C13,4,4,13,4,24	c0,3.4,0.8,6.7,2.5,9.6L3.9,43c-0.1,0.3,0,0.7,0.3,1c0.2,0.2,0.4,0.3,0.7,0.3c0.1,0,0.2,0,0.3,0l9.7-2.5c2.8,1.5,6,2.2,9.2,2.2	c11,0,20-9,20-20c0-5.3-2.1-10.4-5.8-14.1C34.4,6.1,29.4,4,24,4L24,4z"></path><path fill="#40c351" d="M35.2,12.8c-3-3-6.9-4.6-11.2-4.6C15.3,8.2,8.2,15.3,8.2,24c0,3,0.8,5.9,2.4,8.4L11,33l-1.6,5.8l6-1.6l0.6,0.3	c2.4,1.4,5.2,2.2,8,2.2h0c8.7,0,15.8-7.1,15.8-15.8C39.8,19.8,38.2,15.8,35.2,12.8z"></path><path fill="#fff" fill-rule="evenodd" d="M19.3,16c-0.4-0.8-0.7-0.8-1.1-0.8c-0.3,0-0.6,0-0.9,0s-0.8,0.1-1.3,0.6c-0.4,0.5-1.7,1.6-1.7,4	s1.7,4.6,1.9,4.9s3.3,5.3,8.1,7.2c4,1.6,4.8,1.3,5.7,1.2c0.9-0.1,2.8-1.1,3.2-2.3c0.4-1.1,0.4-2.1,0.3-2.3c-0.1-0.2-0.4-0.3-0.9-0.6	s-2.8-1.4-3.2-1.5c-0.4-0.2-0.8-0.2-1.1,0.2c-0.3,0.5-1.2,1.5-1.5,1.9c-0.3,0.3-0.6,0.4-1,0.1c-0.5-0.2-2-0.7-3.8-2.4	c-1.4-1.3-2.4-2.8-2.6-3.3c-0.3-0.5,0-0.7,0.2-1c0.2-0.2,0.5-0.6,0.7-0.8c0.2-0.3,0.3-0.5,0.5-0.8c0.2-0.3,0.1-0.6,0-0.8	C20.6,19.3,19.7,17,19.3,16z" clip-rule="evenodd"></path>
</svg>
  </a>
</div>
<footer class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 py-6 mt-12">
  <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center">
    <p class="text-sm mb-4 md:mb-0">© 2025 HYGIEXPERT 5D. Tous droits réservés.</p>
    <div class="flex flex-wrap justify-center md:justify-start gap-6">
    <a href="{{ route('client.login.form') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Mes fichiers</a>
    <a href="{{ route('client.infos') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Mes informations</a>
    <a href="{{ route('client.contact') }}" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold">Contactez-nous</a>
     
    </div>
  </div>
</footer>
<script type="module" src="{{ asset('js/dash.js') }}"></script>
</body>
</html>