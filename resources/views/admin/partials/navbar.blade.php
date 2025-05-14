<nav class="fixed top-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 shadow-sm">
  <div class="flex justify-between items-center">
    <!-- Logo et Titre -->
    <div class="flex items-center gap-3">
      <img src="{{ asset('images/logo.png') }}" class="h-10" alt="Logo">
      <span class="text-xl font-bold text-gray-800 dark:text-white">AdminPanel</span>
    </div>

    <!-- Menu utilisateur et déconnexion -->
    <div class="flex items-center gap-4">
      <!-- Bouton pour activer/désactiver le Dark Mode -->
      <button onclick="document.documentElement.classList.toggle('dark')" class="text-sm text-gray-600 dark:text-gray-300">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun-moon-icon lucide-sun-moon">
          <path d="M12 8a2.83 2.83 0 0 0 4 4 4 4 0 1 1-4-4"/>
          <path d="M12 2v2"/>
          <path d="M12 20v2"/>
          <path d="m4.9 4.9 1.4 1.4"/>
          <path d="m17.7 17.7 1.4 1.4"/>
          <path d="M2 12h2"/>
          <path d="M20 12h2"/>
          <path d="m6.3 17.7-1.4 1.4"/>
          <path d="m19.1 4.9-1.4 1.4"/>
        </svg>
      </button>

      <!-- Afficher le nom de l'utilisateur connecté -->
      <span class="text-xl flex items-center   font-bold text-gray-900 dark:text-white"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield-user-icon lucide-shield-user"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/> <path d="M6.376 18.91a6 6 0 0 1 11.249.003"/><circle cx="12" cy="11" r="4"/></svg> <p class="pl-1">{{ Auth::user()->name ?? 'Admin' }}</p> </span>

      <!-- Formulaire de déconnexion -->
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 flex items-center">
          <!-- Icône de déconnexion -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" x2="9" y1="12" y2="12"/>
          </svg>
          Déconnexion
        </button>
      </form>
    </div>
  </div>
</nav>