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
  <p id="charCount" class="text-sm mt-1 text-green-500">0 / 200 caractères</p>
</div>
  <button
    type="submit"
    class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-md transition"
  >
    Envoyer
  </button>
</form>

</div>
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

<script type="module" src="{{ asset('js/contact.js') }}"></script>
</body>
</html>