<aside class="fixed top-[78px] left-0 w-64 h-full bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-sm p-5">
  <ul class="space-y-4">

    <li>
      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 text-gray-800 dark:text-white hover:text-indigo-500 font-semibold">
        <i data-lucide="home" class="w-5 h-5"></i>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-pie-icon lucide-chart-pie"><path d="M21 12c.552 0 1.005-.449.95-.998a10 10 0 0 0-8.953-8.951c-.55-.055-.998.398-.998.95v8a1 1 0 0 0 1 1z"/><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/></svg>
        Tableau de bord
      </a>
    </li>

    <li>
      <a href="{{ route('admin.clients.create') }}" class="flex items-center gap-3 text-gray-800 dark:text-white hover:text-indigo-500 font-semibold">
        
        <i data-lucide="users" class="w-5 h-5"></i>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-plus-icon lucide-user-round-plus"><path d="M2 21a8 8 0 0 1 13.292-6"/><circle cx="10" cy="8" r="5"/><path d="M19 16v6"/><path d="M22 19h-6"/></svg>
        Ajouter un client
      </a>
    </li>

    <li>
      <a href="{{ route('admin.clients.store') }}" class="flex items-center gap-3 text-gray-800 dark:text-white hover:text-indigo-500 font-semibold">
        <i data-lucide="settings" class="w-5 h-5"></i>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-logs-icon lucide-logs"><path d="M13 12h8"/><path d="M13 18h8"/><path d="M13 6h8"/><path d="M3 12h1"/><path d="M3 18h1"/><path d="M3 6h1"/><path d="M8 12h1"/><path d="M8 18h1"/><path d="M8 6h1"/></svg>
        Liste des clients 
      </a>
    </li>

  </ul>
</aside>