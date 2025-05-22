<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      body {
        background-image: url('{{ asset('images/bg1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
      }
    </style>
</head>
<body class="bg-blue-300 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">

        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto" />
        </div>

        <form method="POST" action="{{ route('client.login') }}">
            @csrf
    @if($errors->has('login_error'))
        <div class="mb-4 p-3 text-red-700 bg-red-100 rounded">
            {{ $errors->first('login_error') }}
        </div>
    @endif
            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Connexion Client</h2>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-600">Adresse email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    placeholder="nom@exemple.com"
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('email') }}"
                />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
                />
            </div>

            <div class="flex items-center mb-6">
                <input
                    id="remember"
                    type="checkbox"
                    name="remember"
                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded"
                    {{ old('remember') ? 'checked' : '' }}
                />
                <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
            </div>




            <button
                type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50"
            >
                Se connecter
            </button>

       
        </form>
    </div>

</body>
</html>