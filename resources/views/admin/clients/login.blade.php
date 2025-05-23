<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Connexion Client</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    #splash-screen {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      background: white;
      z-index: 9999;
      display: flex;
      justify-content: center;
      align-items: center;
      opacity: 1;
      transition: opacity 0.5s ease-in-out;
    }
    #splash-screen.hide {
      opacity: 0;
      pointer-events: none;
    }
    #splash-screen video {
      width: 25%;
      height: 25%;
      object-fit: cover;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const splash = document.getElementById('splash-screen');
      const video = document.getElementById('splash-video');

      video.addEventListener('ended', () => splash.classList.add('hide'));
      setTimeout(() => splash.classList.add('hide'), 5000);
    });
  </script>
</head>
<body class=" text-gray-800 min-h-screen flex items-center justify-center px-4">

<!-- Splash video screen -->
<div id="splash-screen">
  <video id="splash-video" autoplay muted playsinline>
    <source src="{{ asset('videios/intro.mp4') }}" type="video/mp4">
    Votre navigateur ne supporte pas la vidéo.
  </video>
</div>

<!-- Login content -->
<div class="w-full max-w-6xl bg-white rounded-xl shadow-blue-400 shadow-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">

  <div class="hidden md:block bg-cover bg-center" style="background-image: url('{{ asset('images/bg-login.jpg') }}');"></div>

  <div class="p-8 sm:p-10 flex flex-col justify-center">
    <div class="flex justify-center mb-4">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-[200px] h-auto" />
    </div>

    <div class="text-center mb-8">
      <h2 class="text-2xl font-bold text-gray-800">Connexion Client</h2>
      <p class="text-gray-600">Connectez-vous pour accéder à votre espace personnel.</p>
    </div>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('client.login') }}">
      @csrf

      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Adresse email *</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div class="mb-4">
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
        <input type="password" id="password" name="password" required class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" />
      </div>

      <div class="flex items-center mb-4">
        <input type="checkbox" id="remember" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded" {{ old('remember') ? 'checked' : '' }}>
        <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
      </div>

      <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-md text-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        Se connecter
      </button>
    </form>
  </div>
</div>

</body>
</html>
