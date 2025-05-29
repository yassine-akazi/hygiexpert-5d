<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>404 - Page Non Trouvée</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    /* Animation bounce + fade-in */
    @keyframes bounceFade {
      0%, 100% {
        transform: translateY(0);
        opacity: 1;
      }
      50% {
        transform: translateY(-15px); /* Slightly less bounce */
        opacity: 0.9;
      }
    }

    .bounce-fade {
      animation: bounceFade 2s ease-in-out infinite;
    }

    /* Animation fade-in du contenu */
    .fade-in {
      animation: fadeIn 1.5s ease forwards; /* Slower fade-in */
      opacity: 0;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
  </style>
</head>
<body class="h-full flex items-center justify-center p-4 sm:p-6 lg:p-8">

  <div class="text-center px-6 py-10 max-w-xl w-full bg-white rounded-xl shadow-2xl fade-in flex flex-col items-center justify-center mx-auto my-auto border border-gray-200">
    <div class="mx-auto mb-8 w-28 h-28 rounded-full bg-red-600 flex items-center justify-center shadow-lg transform hover:scale-105 transition-transform duration-300">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-white bounce-fade" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12c0 4.9706-4.0294 9-9 9s-9-4.0294-9-9 4.0294-9 9-9 9 4.0294 9 9z" />
      </svg>
    </div>

    <h1 class="text-8xl sm:text-9xl font-extrabold text-red-700 mb-4 select-none">404</h1>
    <h2 class="text-2xl sm:text-3xl font-semibold text-gray-900 mb-3">Oups, page introuvable !</h2>
    <p class="text-gray-700 text-base sm:text-lg mb-8 leading-relaxed">
      Il semblerait que la page que vous recherchez n'existe pas ou a été déplacée. Veuillez vérifier l'URL ou utiliser le bouton ci-dessous pour retourner à la page d'accueil.
    </p>
    <a href="/" class="inline-block px-8 sm:px-10 py-3 sm:py-4 bg-red-700 text-white rounded-full font-semibold shadow-lg hover:bg-red-800 transition transform hover:-translate-y-1">
      Retour à l'accueil
    </a>
  </div>
 
</body>

</html>
