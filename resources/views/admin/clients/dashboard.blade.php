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

  <!-- SweetAlert2 CDN -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    html { transition: background-color 0.3s, color 0.3s; }
  </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

<nav class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 shadow-sm flex justify-between items-center">
  <div class="flex items-center gap-3">
    <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Logo" />
    <span class="text-xl font-bold text-gray-800 dark:text-white"> </span>
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

<main class="p-6 flex-grow pt-20">

  <h2 class="text-3xl font-extrabold mb-8 text-gray-900 dark:text-white">
  Les Documents  de <span class="text-indigo-600">{{ $client->nom_entreprise }}</span>
  </h2>

  {{-- Filtre par année --}}
  @if($years->count())
    <div class="mb-6 flex flex-wrap gap-3">
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
    <div class="mb-8 flex flex-wrap gap-3">
      @foreach($months as $m)
        <a href="{{ route('client.dashboard', ['year' => $year, 'month' => $m]) }}"
           class="px-3 py-1 rounded-full text-sm font-medium transition
           {{ ($month == $m) ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
          {{ \Carbon\Carbon::create()->month((int)$m)->locale('fr_FR')->isoFormat('MMMM') }}
        </a>
      @endforeach
    </div>
  @endif

  <div class="flex flex-col md:flex-row gap-6">

    {{-- Types de documents --}}
    <div class="md:w-1/4 bg-gray-100 dark:bg-gray-800 rounded p-4 shadow">
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
    <div class="md:w-3/4 bg-white dark:bg-gray-900 rounded shadow p-6 overflow-auto max-h-[600px]">
      @if($documentsGrouped->isEmpty())
        <div class="text-center text-gray-500 dark:text-gray-400 text-lg font-medium">
          Aucun fichier trouvé.
        </div>
      @else
      <form id="download-form" method="POST" action="{{ route('client.documents.downloadZip') }}">
      @csrf
      <div class="flex items-center mb-6">
        <input type="checkbox" id="select-all-global" class="form-checkbox h-6 w-6 text-indigo-600" />
        <label for="select-all-global" class="ml-2 font-semibold">Sélectionner tous les fichiers</label>
        <button id="btnDownloadZip" type="button" class="ml-auto flex items-center px-4 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-1" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
          Télécharger ZIP
        </button>
      </div>

      @foreach ($documentsGrouped as $type => $docs)
        <div class="files-group" data-type="{{ $type }}">
          <h3 class="text-lg font-semibold mb-3">{{ $labels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}</h3>
          @foreach ($docs as $doc) 
          <div class="mb-2 flex items-center bg-gray-50 dark:bg-gray-800 p-3 rounded shadow-sm hover:bg-gray-100 dark:hover:bg-gray-700 transition cursor-pointer">
            <label for="doc_{{ $doc->id }}" class="flex items-center flex-1 cursor-pointer">
              <input type="checkbox" id="doc_{{ $doc->id }}" name="documents[]" value="{{ asset('storage/' . $doc->path) }}" class="form-checkbox h-5 w-5" />
              <span class="ml-3 truncate">{{ basename($doc->path) }}</span>
            </label>

            <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="text-blue-600 mr-4" title="Voir le PDF">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-icon lucide-eye"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>
            </a>

            <a href="{{ asset('storage/' . $doc->path) }}" download class="text-green-600" title="Télécharger">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download-icon lucide-download"><path d="M12 15V3"/><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m7 10 5 5 5-5"/></svg>
            </a>
          </div>
          @endforeach
        </div>
      @endforeach
      </form>
      @endif
    </div>

  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const selectAllGlobal = document.getElementById('select-all-global');
  const typeButtons = document.querySelectorAll('.type-btn');
  const filesGroups = document.querySelectorAll('.files-group');
  const btnDownloadZip = document.getElementById('btnDownloadZip');
  const form = document.getElementById('download-form');

  // Affiche tous les fichiers au départ
  function showFilesByType(type) {
    if (type === 'all') {
      filesGroups.forEach(group => group.style.display = 'block');
    } else {
      filesGroups.forEach(group => {
        group.style.display = group.dataset.type === type ? 'block' : 'none';
      });
    }
  }
  showFilesByType('all');

  // Gestion des boutons de filtre par type
  typeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      typeButtons.forEach(b => b.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg'));
      btn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg');
      const type = btn.dataset.type || btn.getAttribute('data-type');
      showFilesByType(type || 'all');

      selectAllGlobal.checked = false;
      document.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = false);
    });
  });

  // Checkbox globale "Tout sélectionner"
  selectAllGlobal.addEventListener('change', function () {
    const checked = this.checked;
    filesGroups.forEach(group => {
      if (group.style.display === 'block') {
        group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
      }
    });
  });

  // Gestion du clic sur Télécharger ZIP avec SweetAlert2
  btnDownloadZip.addEventListener('click', (e) => {
    e.preventDefault();

    const checkedBoxes = form.querySelectorAll('input[name="documents[]"]:checked');
    if (checkedBoxes.length === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Aucun fichier sélectionné',
        confirmButtonColor: 'gray',
        text: 'Veuillez sélectionner au moins un fichier à télécharger.',
      });
      return;
    }

    Swal.fire({
      title: `Télécharger ${checkedBoxes.length} fichier(s) ?`,
      text: "Voulez-vous vraiment télécharger les fichiers sélectionnés en ZIP ?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: 'green',
      confirmButtonText: 'Oui, télécharger',
      cancelButtonText: 'Annuler',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
});
</script>

</body>
</html>