<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-300 flex justify-center items-center h-screen">

    <!-- Contenu principal -->
    <div class="w-full sm:w-96 bg-white p-8 rounded-lg shadow-lg">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-32 h-auto">
        </div>

        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ url('/admin/login') }}">
            @csrf

            <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Admin Login</h2>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-600">Email Address</label>
                <input type="email" id="email" name="email" class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="name@example.com" required />
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600">Password</label>
                <input type="password" id="password" name="password" class="mt-2 p-3 w-full border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
            </div>

            <!-- Remember me -->
            <div class="flex items-center mb-6">
                <input id="remember" type="checkbox" name="remember" class="w-4 h-4 text-indigo-600 border-gray-300 rounded" />
                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                Login
            </button>

            <!-- Error message -->
            @if($errors->has('login_error'))
                <p class="mt-4 text-red-500 text-sm text-center">{{ $errors->first('login_error') }}</p>
            @endif
        </form>
    </div>

</body>
</html>