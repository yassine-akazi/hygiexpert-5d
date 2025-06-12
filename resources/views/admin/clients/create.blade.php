@extends('layouts.admin')

@section('title', 'Ajouter un client')

@section('navbar')
    @include('admin.partials.navbar')
@endsection

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
@if (session('success'))
    <div class="mb-6 p-4 text-green-800 bg-green-100 border border-green-400 rounded">
        {{ session('success') }}
    </div>
@endif
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
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-6 text-center">Ajouter un client</h2>

        <form id="registerForm" method="POST" action="{{ route('admin.clients.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                    <input type="text" name="nom" id="nom" required value="{{ old('nom') }}"

                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="prenom" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prénom</label>
                    <input type="text" name="prenom" id="prenom" required value="{{ old('prenom') }}"

                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="fonction" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fonction</label>
                    <input type="text" name="fonction" id="fonction" required value="{{ old('fonction') }}"

                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="nom_entreprise" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de l'entreprise</label>
                    <input type="text" name="nom_entreprise" id="nom_entreprise" required value="{{ old('nom_entreprise') }}"
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label for="ice" class="block text-sm font-medium text-gray-700 dark:text-gray-300">ICE</label>
                    <input type="text" name="ice" id="ice" pattern="\d+" title="Seulement des chiffres" required value="{{ old('ice') }}"
                        class=" @error('ice') border-red-500 @else border-gray-300 @enderror mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        @error('ice')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Téléphone</label>
                    <input type="text" name="phone" id="phone" pattern="\d{10}" required    value="{{ old('phone') }}"
                        class=" @error('phone') border-red-500 @else border-gray-300 @enderror mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror

                    <small class="text-gray-500 dark:text-gray-400">10 chiffres uniquement</small>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" required value="{{ old('email') }}" 
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500  @error('email') border-red-500 @else border-gray-300 @enderror">
                        @error('email')
    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
                </div>

                <div>
                    <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Adresse</label>
                    <textarea name="adresse" id="adresse" rows="4" required     
                        class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"> {{ old('adresse') }}</textarea>
                </div>

         
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mot de passe</label>
                    <div class="relative">
                        <input id="password" type="password" name="password"
                            class="mt-1 w-full px-4 py-2 pr-10 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" value="{{ old('password') }}">
                        <button type="button" onclick="togglePassword('password', this)"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-gray-600 dark:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-eye-icon">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirmer le mot de passe</label>
                    <div class="relative">
                        <input id="password_confirmation" value="{{ old('password') }}" type="password" name="password_confirmation" 
                            class="mt-1 w-full px-4 py-2 pr-10 rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500" > 
                        <button type="button" onclick="togglePassword('password_confirmation', this)"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-gray-600 dark:text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-eye-icon">
                                <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </button>
                    </div>
                    <p id="error-message" class="text-red-600 mt-1 hidden">Les mots de passe ne correspondent pas.</p>
                </div>
            </div>

            <div class="text-right">
                <button type="submit"
                    class="mt-4 inline-flex items-center px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition shadow">
                    Ajouter le client
                </button>
            </div>
        </form>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="module" src="{{ asset('js/create.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: @json(session('success')),
            confirmButtonText: 'OK'
        });
    @endif
});
</script>


@endsection