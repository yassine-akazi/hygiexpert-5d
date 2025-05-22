@extends('layouts.admin')

@section('title', 'Fichiers PDF de ' . $client->nom . ' ' . $client->prenom)

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')


<h2 class="text-3xl font-extrabold mb-8 text-gray-900 dark:text-white">
    Fichiers PDF de <span class="text-indigo-600">{{ $client->nom }} {{ $client->prenom }}</span>
</h2>



{{-- Filtre par année --}}
@if($years->count())
    <div class="mb-6 flex flex-wrap gap-3">
        {{-- Bouton Tous --}}
        <a href="{{ route('admin.clients.showPdfsByYear', ['id' => $client->id]) }}"
           class="px-3 py-2 rounded-full text-sm font-semibold transition
               {{ !$year ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
            Tous
        </a>

        {{-- Liste des années --}}
        @foreach($years as $y)
            <a href="{{ route('admin.clients.showPdfsByYear', ['id' => $client->id, 'year' => $y]) }}"
               class="px-3 py-2 rounded-full text-sm font-semibold transition
               {{ $year == $y ? 'bg-indigo-600 text-white shadow-lg' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
                {{ $y }}
            </a>
        @endforeach
    </div>
@endif

{{-- Filtre par mois si une année est sélectionnée --}}
@if($year && $months->count())
    <div class="mb-8 flex flex-wrap gap-3">
        @foreach($months as $m)
            <a href="{{ route('admin.clients.showPdfsByYear', ['id' => $client->id, 'year' => $year, 'month' => $m]) }}"
               class="px-3 py-1 rounded-full text-sm font-medium transition
                   {{ ($month == $m) ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-indigo-500 hover:text-white' }}">
                {{ \Carbon\Carbon::create()->month((int)$m)->locale('fr_FR')->isoFormat('MMMM') }}
            </a>
        @endforeach
    </div>
@endif

<div class="flex flex-col md:flex-row gap-6">


    {{-- Sidebar : Types --}}
    <div class="md:w-1/4 bg-gray-100 dark:bg-gray-800 rounded p-4 shadow">
        <h3 class="font-bold mb-4 text-gray-700 dark:text-gray-200">Types de documents</h3>
        <ul id="typeList" class="space-y-2">
            <li>
                <button data-type="all" class="dark:text-gray-200 type-btn px-3 py-1 rounded bg-indigo-600 text-white font-semibold w-full text-left">
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

    {{-- Contenu : fichiers --}}
    <div class="md:w-3/4">
    @if(session('success'))
        <div class="mb-6 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
        <form id="delete-form" action="{{ route('admin.clients.deleteDocuments', $client->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('DELETE')

            <div class="flex items-center justify-between mb-6 space-x-4">
                {{-- Checkbox globale --}}
                <div class="flex items-center space-x-3">
                    <input
                        type="checkbox"
                        id="select-all-global"
                        class="form-checkbox h-6 w-6 text-indigo-600 rounded focus:ring-indigo-500 border-gray-300 dark:border-gray-600 cursor-pointer"
                    />
                    <label for="select-all-global" class="text-lg font-semibold text-gray-800 dark:text-gray-200 cursor-pointer">
                        Sélectionner tous les fichiers
                    </label>
                </div>

                {{-- Boutons --}}
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.clients.upload.form', $client->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                             width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round" 
                             class="lucide lucide-folder-plus-icon mr-2">
                            <path d="M12 10v6"/>
                            <path d="M9 13h6"/>
                            <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"/>
                        </svg>
                        Ajouter des fichiers
                    </a>
                    <button
                        type="button"
                        id="btnOpenConfirm"
                        class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded font-semibold shadow-lg transition-colors duration-300 flex items-center space-x-2"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-trash-2 text-white"
                        >
                            <path d="M3 6h18"/>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                            <line x1="10" y1="11" x2="10" y2="17"/>
                            <line x1="14" y1="11" x2="14" y2="17"/>
                        </svg>
                        <span>Supprimer</span>
                    </button>
                </div>
            </div>

            <div id="filesContainer" class="space-y-6 overflow-y-auto max-h-[600px] rounded-lg shadow-lg border border-gray-300 dark:border-gray-700 p-4 bg-white dark:bg-gray-900">
                @foreach ($documentsGrouped as $type => $docs)
                    <div class="files-group" data-type="{{ $type }}" style="display:none;">
                        <h3 class="text-lg font-semibold mb-3 text-gray-900 dark:text-gray-100">{{ $labels[$type] ?? ucfirst(str_replace('_', ' ', $type)) }}</h3>

                        {{-- Checkbox “Tout sélectionner” par type --}}
                        <div class="mb-4">
                            <label class="inline-flex items-center space-x-2 cursor-pointer text-indigo-600 dark:text-indigo-400 font-semibold">
                                <input type="checkbox" class="select-all-type form-checkbox h-5 w-5 rounded focus:ring-indigo-500 border-gray-300 dark:border-gray-600 cursor-pointer" data-type="{{ $type }}" />
                                <span>Sélectionner tous ({{ $docs->count() }})</span>
                            </label>
                        </div>
        

                        @foreach ($docs as $doc)
                            <div class="mb-1 flex items-center space-x-4 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg shadow-sm hover:shadow-md transition-shadow cursor-pointer group">
                                <input type="checkbox" name="documents[]" value="{{ $doc->id }}" id="doc_{{ $doc->id }}" class="form-checkbox h-5 w-5 rounded focus:ring-indigo-500 border-gray-300 dark:border-gray-600 type-checkbox-{{ $type }} cursor-pointer" />
                                
                                <label for="doc_{{ $doc->id }}" class="flex-1 truncate text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 transition-colors">
                                    <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" class="block hover:underline">
                                        {{ basename($doc->path) }}
                                    </a>
                                </label>

                                <a href="{{ asset('storage/' . $doc->path) }}" target="_blank" title="Voir le PDF" class="text-indigo-500 hover:text-indigo-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
                                    </svg>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
                @if($documentsGrouped->isEmpty())
    <div class="text-center py-20 text-gray-500 dark:text-gray-400 text-lg font-medium">
        Aucun fichier trouvé.
    </div>
@else
    <!-- Ton formulaire et affichage des fichiers -->
@endif
            </div>
            
        </form>

    </div>
</div>

{{-- Modal suppression --}}
<div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md">
        <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Confirmation de suppression</h2>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Es-tu sûr de vouloir supprimer les fichiers sélectionnés ? Cette action est irréversible.</p>
        <div class="flex justify-end space-x-3">
            <button id="btnCancel" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Annuler</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-300 dark:hover:bg-gray-700">Supprimer</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('confirmModal');
    const btnOpenConfirm = document.getElementById('btnOpenConfirm');
    const btnCancel = document.getElementById('btnCancel');
    const btnConfirmDelete = document.getElementById('confirmDeleteBtn');
    const form = document.getElementById('delete-form');
    const selectAllGlobal = document.getElementById('select-all-global');
    const typeButtons = document.querySelectorAll('.type-btn');
    const filesGroups = document.querySelectorAll('.files-group');

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
            // Reset checkboxes
            selectAllGlobal.checked = false;
            document.querySelectorAll('.select-all-type').forEach(cb => cb.checked = false);
            document.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = false);
        });
    });

    // Checkbox globale "Tout sélectionner"
    selectAllGlobal.addEventListener('change', function() {
        const checked = this.checked;
        filesGroups.forEach(group => {
            if (group.style.display === 'block') {
                group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
                const type = group.dataset.type;
                const selectAllTypeCheckbox = document.querySelector(`.select-all-type[data-type="${type}"]`);
                if (selectAllTypeCheckbox) selectAllTypeCheckbox.checked = checked;
            }
        });
    });

    // Checkbox "Tout sélectionner" par type
    document.querySelectorAll('.select-all-type').forEach(selectAllTypeCheckbox => {
        selectAllTypeCheckbox.addEventListener('change', function() {
            const type = this.dataset.type;
            const checked = this.checked;
            const group = document.querySelector(`.files-group[data-type="${type}"]`);
            if (group && group.style.display === 'block') {
                group.querySelectorAll('input[name="documents[]"]').forEach(cb => cb.checked = checked);
            }
            const allTypeChecked = Array.from(document.querySelectorAll('.select-all-type')).every(cb => cb.checked);
            selectAllGlobal.checked = allTypeChecked;
        });
    });

    // Mise à jour checkboxes individuelles
    form.querySelectorAll('input[name="documents[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(form.querySelectorAll('input[name="documents[]"]')).every(cb => cb.checked);
            selectAllGlobal.checked = allChecked;

            const types = [...new Set(Array.from(form.querySelectorAll('input[name="documents[]"]')).map(cb => {
                const match = cb.className.match(/type-checkbox-([^ ]+)/);
                return match ? match[1] : null;
            }).filter(Boolean))];

            types.forEach(type => {
                const typeCheckboxes = form.querySelectorAll(`.type-checkbox-${CSS.escape(type)}`);
                const allTypeChecked = Array.from(typeCheckboxes).every(cb => cb.checked);
                const selectAllTypeCheckbox = document.querySelector(`.select-all-type[data-type="${type}"]`);
                if (selectAllTypeCheckbox) selectAllTypeCheckbox.checked = allTypeChecked;
            });
        });
    });

    // Modale de confirmation suppression
    function openConfirmModal() {
        modal.classList.remove('hidden');
    }

    function closeConfirmModal() {
        modal.classList.add('hidden');
    }

    btnOpenConfirm.addEventListener('click', function() {
        const anyChecked = Array.from(form.querySelectorAll('input[name="documents[]"]')).some(cb => cb.checked);
        if (!anyChecked) {
           
            return;
        }
        openConfirmModal();
    });

    btnCancel.addEventListener('click', closeConfirmModal);

    btnConfirmDelete.addEventListener('click', function() {
        form.submit();
    });
});
</script>

@endsection