<aside class="fixed top-[78px] left-0 w-64 h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 shadow-md p-6 flex flex-col">
  <nav class="flex-1">
    <ul class="space-y-4">
      <li>
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center gap-3 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition-colors duration-200">
          <!-- Home / Dashboard Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z"/>
            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"/>
          </svg>
          Tableau de bord
        </a>
      </li>

      <li>
        <a href="{{ route('admin.clients.create') }}" 
           class="flex items-center gap-3 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition-colors duration-200">
          <!-- Add Client Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M2 21a8 8 0 0 1 13.292-6"/>
            <circle cx="10" cy="8" r="5"/>
            <path d="M19 16v6"/>
            <path d="M22 19h-6"/>
          </svg>
          Ajouter un client
        </a>
      </li>

      <li>
        <a href="{{ route('admin.clients') }}" 
           class="flex items-center gap-3 text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition-colors duration-200">
          <!-- Clients List Icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M13 12h8"/>
            <path d="M13 18h8"/>
            <path d="M13 6h8"/>
            <path d="M3 12h1"/>
            <path d="M3 18h1"/>
            <path d="M3 6h1"/>
            <path d="M8 12h1"/>
            <path d="M8 18h1"/>
            <path d="M8 6h1"/>
          </svg>
          Liste des clients
        </a>
      </li>
    </ul>
  </nav>
</aside>