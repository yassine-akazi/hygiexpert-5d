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
    <div class="alert alert-danger mb-6">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center">Modifier un client</h2>

        <form method="POST" action="{{ route('admin.clients.update', $client->id) }}" class="space-y-6">
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

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe (laisser vide si inchangé)</label>
                    <input type="password" name="password" id="password"
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                    class="mt-4 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition shadow">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection