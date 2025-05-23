<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion Client</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#f0fbd6] via-[#d0f0ff] via-[#fff9cc] to-[#ffd6d6] text-gray-800 min-h-screen flex items-center justify-center px-4">

  <!-- Contenu principal -->
  <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg grid grid-cols-1 md:grid-cols-2 overflow-hidden">

    <!-- Image côté gauche (masquée sur mobile) -->
    <div
      class="hidden md:block bg-cover bg-center"
      style="background-image: url('{{ asset('images/bg1.jpg') }}');"
    ></div>

    <!-- Formulaire côté droit -->
    <div class="p-8 sm:p-10 flex flex-col justify-center">

      <!-- Logo -->
      <div class="flex justify-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-24 h-auto" />
      </div>

      <!-- Texte d'intro -->
      <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Connexion Client</h2>
        <p class="text-gray-600">Connectez-vous pour accéder à votre espace personnel.</p>
      </div>

      <!-- Affichage erreurs -->
      @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
          @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
          @endforeach
        </div>
      @endif

      <!-- Formulaire -->
      <form method="POST" action="{{ route('client.login') }}">
        @csrf

        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Adresse email *</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required
            class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
          <input type="password" id="password" name="password" required
            class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>

        <div class="flex items-center mb-4">
          <input type="checkbox" id="remember" name="remember"
            class="w-4 h-4 text-indigo-600 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
          <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
        </div>

        <button type="submit"
          class="w-full bg-indigo-600 text-white py-3 rounded-md text-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
          Se connecter
        </button>
      </form>

    </div>
  </div>

</body>
</html>