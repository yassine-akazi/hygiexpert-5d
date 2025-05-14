@extends('layouts.admin')

@section('title', 'Edit Client')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <h2 class="text-2xl font-bold mb-6">Edit Client</h2>

    <form method="POST" action="{{ route('admin.clients.update', $client->id) }}">
        @csrf
        @method('PUT')

        <!-- Nom -->
        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="nom" id="nom" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('nom', $client->nom) }}" required>
        </div>

        <!-- Prénom -->
        <div class="mb-4">
            <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('prenom', $client->prenom) }}" required>
        </div>

        <!-- Fonction -->
        <div class="mb-4">
            <label for="fonction" class="block text-sm font-medium text-gray-700">Fonction</label>
            <input type="text" name="fonction" id="fonction" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('fonction', $client->fonction) }}" required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('email', $client->email) }}" required>
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('phone', $client->phone) }}" required>
        </div>

        <!-- ICE -->
        <div class="mb-4">
            <label for="ice" class="block text-sm font-medium text-gray-700">ICE</label>
            <input type="text" name="ice" id="ice" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ old('ice', $client->ice) }}" required>
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="adresse" class="block text-sm font-medium text-gray-700">Address</label>
            <textarea name="adresse" id="adresse" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" rows="4" required>{{ old('adresse', $client->adresse) }}</textarea>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Update Client</button>
        </div>
    </form>
@endsection