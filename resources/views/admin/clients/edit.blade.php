@extends('layouts.admin')

@section('title', 'Modifier un client')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
@if ($errors->any())
    <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center">Modifier un client</h2>

        <form id="editClientForm" method="POST" action="{{ route('admin.clients.update', $client->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $client->nom) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $client->prenom) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="fonction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fonction</label>
                    <input type="text" name="fonction" id="fonction" value="{{ old('fonction', $client->fonction) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="nom_entreprise" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de l'entreprise</label>
                    <input type="text" name="nom_entreprise" id="nom_entreprise" value="{{ old('nom_entreprise', $client->nom_entreprise) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="ice" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ICE</label>
                    <input type="text" name="ice" id="ice" value="{{ old('ice', $client->ice) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                    <input type="text" name="phone" id="phone" pattern="\d{10}" value="{{ old('phone', $client->phone) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    <small class="text-gray-500 dark:text-gray-400">10 chiffres uniquement</small>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $client->email) }}" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                    <textarea name="adresse" id="adresse" rows="4" required
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">{{ old('adresse', $client->adresse) }}</textarea>
                </div>

                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                    <input id="password" type="password" name="password"
                        class="mt-1 w-full px-4 py-2 pr-10 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="button" onclick="togglePassword('password', this)"
                        class="absolute right-2 top-8 text-gray-500 text-xl">👁️</button>
                </div>

                <div class="relative">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        class="mt-1 w-full px-4 py-2 pr-10 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    <button type="button" onclick="togglePassword('password_confirmation', this)"
                        class="absolute right-2 top-8 text-gray-500 text-xl">👁️</button>
                    <p id="error-message" class="text-red-600 mt-1 hidden">Les mots de passe ne correspondent pas.</p>
                </div>
            </div>

            <div class="text-right">
                <button type="button"
                    onclick="openConfirmationModal()"
                    class="mt-4 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition shadow">
                    Mettre à jour
                </button>
                <a href="{{ route('admin.clients') }}"
                    class="mt-4 inline-flex items-center px-6 py-2 bg-gray-400 text-gray-800 font-semibold rounded-md hover:bg-gray-500 transition shadow">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Modal de confirmation -->
<div id="confirmationModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Confirmer la modification</h3>
        <p class="text-gray-600 dark:text-gray-300 mb-6">Voulez-vous vraiment enregistrer les modifications de ce client ?</p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeConfirmationModal()"
                class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-800 dark:text-white rounded hover:bg-gray-400 dark:hover:bg-gray-700">
                Annuler
            </button>
            <button onclick="submitEditForm()"
                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Confirmer
            </button>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    function openConfirmationModal() {
        document.getElementById('confirmationModal').classList.remove('hidden');
        document.getElementById('confirmationModal').classList.add('flex');
    }

    function closeConfirmationModal() {
        document.getElementById('confirmationModal').classList.remove('flex');
        document.getElementById('confirmationModal').classList.add('hidden');
    }

    function submitEditForm() {
        document.getElementById('editClientForm').submit();
    }

    function togglePassword(id, button) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            button.textContent = "🙈";
        } else {
            input.type = "password";
            button.textContent = "👁️";
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('editClientForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        const errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function (e) {
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                errorMessage.classList.remove('hidden');
            } else {
                errorMessage.classList.add('hidden');
            }
        });

        password.addEventListener('input', () => errorMessage.classList.add('hidden'));
        confirmPassword.addEventListener('input', () => errorMessage.classList.add('hidden'));
    });
</script>
@endsection