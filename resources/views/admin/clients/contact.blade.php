<!DOCTYPE html>
<html lang="fr"
  x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
  :class="{ 'dark': darkMode }"
  x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value))"
>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact - {{ $client->nom ?? 'Invité' }} {{ $client->prenom ?? '' }}</title>
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script> tailwind.config = { darkMode: 'class' } </script>

  <!-- Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">

<!-- Navigation -->
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

<!-- Contenu principal -->
<div class="container mx-auto mt-24 p-6 flex-grow">



  <form method="POST" action="{{ route('client.contact.store') }}" class="max-w-lg mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow space-y-6 ">
  @csrf
  @if(session('success'))
  <div class="bg-green-100 border border-green-400 text-green-800 p-4 rounded mb-4 shadow">
    {{ session('success') }}
  </div>
  @endif
  <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Contactez-nous</h2>

  <div>
  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet</label>
  <input
    id="name" name="name" type="text" required
    value="{{ $client?->nom }} {{ $client?->prenom }}"
    placeholder="Votre nom"
    readonly
    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white cursor-not-allowed focus:outline-none"
  />
</div>

<div>
  <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
  <input
    id="email" name="email" type="email" required
    value="{{ $client?->email }}"
    placeholder="Votre email"
    readonly
    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white cursor-not-allowed focus:outline-none"
  />
</div>

<div>
  <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
    Message
  </label>
  <textarea
    id="message"
    name="message"
    rows="5"
    maxlength="200"
    required
    placeholder="Votre message (max. 200 caractères)"
    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500"
    oninput="updateCharCount()"
  ></textarea>
  <div id="charCount" class="text-sm text-gray-500 dark:text-gray-400 mt-1 text-right">
    0 / 200 caractères
  </div>
</div>
  <button
    type="submit"
    class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition"
  >
    Envoyer
  </button>
</form>

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
<script>
  function updateCharCount() {
    const textarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    const length = textarea.value.length;

    charCount.textContent = `${length} / 200 caractères`;

    if (length >= 200) {
      charCount.classList.remove('text-green-500');
      charCount.classList.add('text-red-500');
    } else {
      charCount.classList.remove('text-red-500');
      charCount.classList.add('text-green-500');
    }
  }

  // Appeler la fonction au chargement de la page
  document.addEventListener('DOMContentLoaded', updateCharCount);
</script>
</body>
</html>