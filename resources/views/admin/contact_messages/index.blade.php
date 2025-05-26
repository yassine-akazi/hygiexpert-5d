@extends('layouts.admin')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection
@php
use Illuminate\Support\Str;

$max = 200;
@endphp
@section('content')
<h1 class="text-3xl font-semibold text-gray-800 dark:text-white mb-6"> Messages reçus</h1>

<div class="flex justify-between items-center mb-4 mx-auto  gap-4">
  {{-- Recherche --}}
  <form method="GET" action="{{ route('admin.contact_messages.index') }}" class="flex-grow max-w-md flex gap-2 items-center">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Recherche par nom ou email"
      class="px-4 py-2 border border-gray-700 rounded-l flex-grow dark:bg-gray-700 dark:text-white"
    />
    <button 
      type="submit" 
      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-r flex items-center gap-2"
      title="Rechercher"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search">
        <circle cx="11" cy="11" r="8"/>
        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      Rechercher
    </button>
  </form>

  {{-- Bouton de suppression avec popup --}}
  <button 
    type="button" 
    onclick="confirmDelete()"
    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded shadow flex items-center gap-2"
    title="Supprimer la sélection"
  >
    Supprimer
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M19 7L5 7M10 11v6M14 11v6M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12"/>
      <path stroke-linecap="round" stroke-linejoin="round" d="M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3"/>
    </svg>
  </button>
</div>

{{-- Formulaire de suppression (pas de bouton ici, soumis par JS) --}}
<form id="deleteMessagesForm" method="POST" action="{{ route('admin.contact_messages.delete') }}">
  @csrf
  @method('DELETE')

  <div 
    x-data="{ selectAll: false }" 
    x-init="$watch('selectAll', value => {
      document.querySelectorAll('.message-checkbox').forEach(cb => cb.checked = value);
    })" 
    class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-4"
  >
    <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
      <thead class="bg-gray-100 dark:bg-gray-700 uppercase text-xs font-semibold">
        <tr>
          <th class="px-4 py-3">
            <input type="checkbox" x-model="selectAll" class="h-4 w-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
          </th>
          <th class="px-6 py-3">Nom</th>
          <th class="px-6 py-3">Email</th>
          <th class="px-6 py-3 max-w-md">Message</th>
          <th class="px-6 py-3">📅 Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($messages as $msg)
        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition duration-150 ease-in-out">
          <td class="px-4 py-4">
            <input type="checkbox" name="selected[]" value="{{ $msg->id }}" form="deleteMessagesForm"
              class="message-checkbox h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
          </td>
          <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
            {{ $msg->name }}
          </td>
          <td class="px-6 py-4 text-gray-700 dark:text-gray-300 whitespace-nowrap">
            {{ $msg->email }}
          </td>
          <td class="px-6 py-4 text-gray-700 dark:text-gray-300 max-w-3xl overflow-hidden break-words">
  @php
    $max = 200;
    $message = $msg->message;
    $truncated = \Illuminate\Support\Str::limit($message, $max, '...');
  @endphp

  @if (strlen($message) > $max)
    <span 
      x-data="{ showFull: false }"
      x-on:click="showFull = true; $dispatch('open-modal', { message: '{{ addslashes($message) }}' })"
      class="cursor-pointer underline hover:text-indigo-600"
    >
      {{ $truncated }}
    </span>
  @else
    {{ $message }}
  @endif
</td>
          <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">
            {{ $msg->created_at->format('d/m/Y H:i') }}
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">Aucun message trouvé.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Bouton Supprimer -->
 
  </div>
</form>

<div class="mt-6 max-w-4xl mx-auto">
  {{ $messages->links() }}
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete() {
  const checkedCount = document.querySelectorAll('.message-checkbox:checked').length;

  if (checkedCount === 0) {
    Swal.fire({
      icon: 'warning',
      title: 'Aucun message sélectionné',
      text: 'Veuillez sélectionner au moins un message à supprimer.',
    });
    return;
  }

  Swal.fire({
    title: 'Êtes-vous sûr ?',
    text: `Vous allez supprimer ${checkedCount} message(s). Cette action est irréversible !`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Oui, supprimer',
    cancelButtonText: 'Annuler'
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById('deleteMessagesForm').submit();
    }
  });
}
</script>

@endsection