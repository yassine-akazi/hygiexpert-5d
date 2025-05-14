@extends('layouts.admin')

@section('title', 'Ajouter un client')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <h2 class="text-2xl font-bold mb-6">Ajouter un client</h2>

    <form method="POST" action="{{ route('admin.clients.store') }}">
        @csrf

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
            <input type="text" name="nom" id="nom" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Fonction -->
        <div class="mb-4">
            <label for="fonction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fonction</label>
            <input type="text" name="fonction" id="fonction" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Nom de l'entreprise -->
        <div class="mb-4">
            <label for="nom_entreprise" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de l'entreprise</label>
            <input type="text" name="nom_entreprise" id="nom_entreprise" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- ICE -->
        <div class="mb-4">
            <label for="ice" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ICE</label>
            <input type="text" name="ice" id="ice" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Téléphone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Numéro de téléphone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" pattern="\d{10}" required>
            <small class="text-gray-500 dark:text-gray-300">10 chiffres uniquement</small>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>

        <!-- Adresse -->
        <div class="mb-4">
            <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
            <textarea name="adresse" id="adresse" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="4" required></textarea>
        </div>

        <!-- Bouton Soumettre -->
        <div class="mb-4">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Ajouter le client
            </button>
        </div>
    </form>
@endsection