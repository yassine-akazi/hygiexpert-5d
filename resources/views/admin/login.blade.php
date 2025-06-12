<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin</title>
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-image: url('/images/bg-login-admin.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      
    }

    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(15px);
      -webkit-backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in': 'fadeIn 0.6s ease-out',
          },
          keyframes: {
            fadeIn: {
              '0%': { opacity: 0, transform: 'translateY(10px)' },
              '100%': { opacity: 1, transform: 'translateY(0)' },
            },
          },
        },
      },
    };
  </script>
</head>
<body class="flex items-center justify-center h-screen bg-black/70">

  <div class="glass w-full sm:w-[400px] p-8 rounded-2xl shadow-2xl text-black animate-fade-in duration-500">

    <!-- Logo -->
    <div class="flex justify-center mb-8 -">
      <img src="{{ asset('images/favicon.png') }}" alt="Logo" class="w-[150px] h-auto drop-shadow-lg ">
    </div>

    <!-- Formulaire -->
    <form method="POST" action="{{ url('/admin/login') }}">
      @csrf

      <h2 class="text-3xl font-bold text-center mb-8 tracking-wide">Admin Login</h2>

      <!-- Email -->
      <div class="mb-6">
        <label for="email" class="block text-sm font-medium text-black/80">Email Address</label>
        <input type="email" id="email" name="email" placeholder="admin@example.com"
          class="mt-2 p-3 w-full rounded-xl bg-white/20 border border-white/30 text-black placeholder-black/60 focus:outline-none focus:ring-2 focus:ring-cyan-400" required />
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-black/80">Password</label>
        <input type="password" id="password" name="password" value="{{ old('email', $email ?? '') }}"
          class="mt-2 p-3 w-full rounded-xl bg-white/20 border border-white/30 text-black placeholder-black/60 focus:outline-none focus:ring-2 focus:ring-cyan-400" required />
      </div>

      <!-- Remember me -->
      <div class="flex items-center mb-6">
        <input id="remember" type="checkbox" name="remember"
          class="w-4 h-4 text-cyan-500 bg-transparent border-gray-300 rounded" {{ old('remember') || !empty($email) ? 'checked' : '' }} />
        <label for="remember" class="ml-2 text-sm text-black/70">Remember me</label>
      </div>

      <!-- Submit -->
      <button type="submit"
        class="w-full bg-cyan-500 hover:bg-cyan-600 text-white py-3 rounded-xl text-lg font-semibold transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-opacity-50">
        Login
      </button>

      <!-- Message d'erreur -->
      @if($errors->has('login_error'))
        <p class="mt-4 text-red-400 text-sm text-center">{{ $errors->first('login_error') }}</p>
      @endif
    </form>
  </div>

</body>
</html>