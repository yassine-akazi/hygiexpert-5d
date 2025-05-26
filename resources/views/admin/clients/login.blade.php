<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HYGIEXPERT 5D</title>
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes slide {
      0% { transform: translateX(0%); }
      100% { transform: translateX(-50%); }
    }
    .animate-slide {
      animation: slide 20s linear infinite;
      width: max-content;
    }
    @keyframes fadeScaleIn {
      0% { opacity: 0; transform: scale(0.95); }
      100% { opacity: 1; transform: scale(1); }
    }
    .fade-scale-in {
      animation: fadeScaleIn 0.6s ease forwards;
      animation-delay: 0.3s;
      opacity: 0;
    }
    .btn-3d {
      background: linear-gradient(145deg, #4f46e5, #3730a3);
      box-shadow: 0 5px 15px rgba(79, 70, 229, 0.6), 0 8px 20px rgba(55, 48, 163, 0.4);
      transition: transform 0.15s ease, box-shadow 0.15s ease;
      transform-style: preserve-3d;
      perspective: 1000px;
    }
    .btn-3d:hover {
      box-shadow: 0 12px 24px rgba(79, 70, 229, 0.8), 0 18px 40px rgba(55, 48, 163, 0.6);
      transform: translateY(-5px);
    }
    .btn-3d:active {
      transform: translateY(-2px) scale(0.98);
      box-shadow: 0 6px 12px rgba(79, 70, 229, 0.7), 0 9px 18px rgba(55, 48, 163, 0.5);
    }
    
  </style>
</head>

<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen justify-between">

  <!-- Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-40">

    <!-- Bouton Hamburger Mobile -->
    <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
        <path d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- Menu Desktop -->
    <nav class="space-x-6 hidden md:flex">
      <a href="#heroSlider" class="text-gray-700 hover:text-indigo-600 font-medium">Accueil</a>
      <a href="#about" class="text-gray-700 hover:text-indigo-600 font-medium">À propos</a>
      <a href="#services" class="text-gray-700 hover:text-indigo-600 font-medium">Services</a>
      <a href="#boutique" class="text-gray-700 hover:text-indigo-600 font-medium">Boutique</a>
      <a href="#map" class="text-gray-700 hover:text-indigo-600 font-medium">Localisation</a>
      <a href="#login" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition-all duration-200 btn-3d flex items-center">
        Connexion
      </a>
    </nav>
  </div>

  <!-- Menu Mobile -->
  <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
    <nav class="flex flex-col space-y-2">
      <a href="#heroSlider" class="text-gray-700 hover:text-indigo-600 font-medium">Accueil</a>
      <a href="#about" class="text-gray-700 hover:text-indigo-600 font-medium">À propos</a>
      <a href="#services" class="text-gray-700 hover:text-indigo-600 font-medium">Services</a>
      <a href="#boutique" class="text-gray-700 hover:text-indigo-600 font-medium">Boutique</a>
      <a href="#map" class="text-gray-700 hover:text-indigo-600 font-medium">Localisation</a>
      <div class="flex justify-center">
  <a href="#login" class="inline-flex gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 transition-all duration-200 btn-3d flex items-center">
    Connexion
  </a>
</div>
    </nav>
  </div>
</header>


  <!-- Hero Slider -->
<section class="relative h-[500px] overflow-hidden">
   <div id="heroSlider" class="absolute inset-0 flex transition-transform duration-1000">
      <div class="min-w-full bg-cover bg-center" style="background-image: url('{{ asset('images/slider1.jpg') }}');"></div>
      <div class="min-w-full bg-cover bg-center" style="background-image: url('{{ asset('images/slider2.jpg') }}');"></div>
      <div class="min-w-full bg-cover bg-center" style="background-image: url('{{ asset('images/slider3.jpg') }}');"></div>
    </div>
    <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-center text-white z-10 px-6">
      <div class="fade-scale-in max-w-3xl">
        <h1 class="text-5xl md:text-6xl font-extrabold mb-4 tracking-tight">Bienvenue chez HYGIEXPERT 5D</h1>
        <p class="text-lg md:text-xl mb-6 leading-relaxed">Experts en dératisation, désinsectisation, déréptilisation, dépigeonnage et désinfection</p>
        <a href="#services" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition">
        Découvrir nos services
      </a>
      </div>
    </div>
</section>

  <!-- About Us -->
  <section id="about" class="py-16 bg-gray-100">
  <div class="max-w-6xl mx-auto px-6 md:px-10">
    <div class="text-center mb-12">
      <h2 class="text-4xl font-extrabold text-gray-800 mb-4">À propos de HYGIEXPERT 5D</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
      <!-- Texte -->
      <div>
        <h3 class="text-2xl font-bold  mb-4">Qui sommes-nous ?
        </h3>
        <p class="text-gray-700 leading-relaxed mb-4 font-semibold text-justify">
          Depuis plusieurs années, HYGIEXPERT 5D accompagne ses clients dans la prévention et le traitement des nuisibles grâce à des techniques modernes, efficaces et respectueuses de l’environnement.
        </p>
        <p class="text-gray-700 leading-relaxed font-semibold text-justify">
        HYGIEXPERT 5D est une société spécialisée et reconnue dans le domaine de l’hygiène parasitaire. Leader sur le marché, nous intervenons avec efficacité et professionnalisme dans les services de dératisation, désinsectisation, déréptilisation, dépigeonnage et désinfection.
        Notre expertise repose sur des solutions innovantes, respectueuses de l’environnement et conformes aux normes en vigueur, pour garantir à nos clients un environnement sain, sécurisé et durable.        </p>
      </div>

      <!-- Image -->
      <div>
        <img src="{{ asset('images/about-us.jpg') }}" alt="À propos" class="rounded-xl shadow-xl w-full h-auto object-cover">
      </div>
    </div>
  </div>
</section>
<section id="services" class="py-16 bg-gray-50">
  <div class="max-w-7xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-extrabold text-gray-800 mb-10">Nos Services</h2>

    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-3 gap-10">

      <!-- 1. Dératisation -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
        <h3 class="text-xl font-semibold mb-2">Dératisation</h3>
        <p class="text-gray-600 mb-4 text-center">Élimination efficace des rats et souris pour protéger vos locaux et assurer votre sécurité.</p>
        <img src="{{ asset('images/services/deratisation.jpg') }}" alt="Dératisation" class="w-full h-40 object-cover rounded-lg" />
      </div>

      <!-- 2. Désinsectisation -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
        <h3 class="text-xl font-semibold mb-2">Désinsectisation</h3>
        <p class="text-gray-600 mb-4 text-center">Traitement ciblé contre les insectes nuisibles pour préserver votre confort et votre santé.</p>
        <img src="{{ asset('images/services/desinsectisation.jpg') }}" alt="Désinsectisation" class="w-full h-40 object-cover rounded-lg" />
      </div>

      <!-- 3. Dérptilisation -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
        <h3 class="text-xl font-semibold mb-2">Dérptilisation</h3>
        <p class="text-gray-600 mb-4 text-center">Contrôle et élimination des reptiles pour protéger vos espaces de vie et de travail.</p>
        <img src="{{ asset('images/services/derptilisation.jpg') }}" alt="Dérptilisation" class="w-full h-40 object-cover rounded-lg" />
      </div>

      <!-- 4. Dépigeonnage - commence à la 2ème colonne -->
      <div class="lg:col-start-2 bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
        <h3 class="text-xl font-semibold mb-2">Dépigeonnage</h3>
        <p class="text-gray-600 mb-4 text-center">Solutions efficaces pour éloigner et contrôler la population de pigeons nuisibles.</p>
        <img src="{{ asset('images/services/depigeonnage.jpg') }}" alt="Dépigeonnage" class="w-full h-40 object-cover rounded-lg" />
      </div>

      <!-- 5. Désinfection -->
      <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition flex flex-col items-center">
        <h3 class="text-xl font-semibold mb-2">Désinfection</h3>
        <p class="text-gray-600 mb-4 text-center">Nettoyage et désinfection professionnels pour un environnement sain et sécurisé.</p>
        <img src="{{ asset('images/services/desinfection.jpg') }}" alt="Désinfection" class="w-full h-40 object-cover rounded-lg" />
      </div>

    </div>
  </div>
</section>
<!-- PARTENAIRES -->
<section class="py-5 bg-white">
  <h2 class="text-center text-3xl font-extrabold text-gray-700 mb-3">Ils nous font confiance</h2>
  <div class="overflow-hidden max-w-7xl mx-auto px-6">
    <div class="animate-slide flex gap-6">
      @for ($i = 0; $i < 3; $i++) {{-- Répétition pour un défilement long --}}
        @for ($j = 1; $j <= 9; $j++)
          <img src="{{ asset('images/partenaires/logo' . $j . '.png') }}"
               alt="Partenaire {{ $j }}"
               class="h-20 object-contain  transition duration-300" />
        @endfor
      @endfor
    </div>
  </div>
</section>

<!-- CERTIFICATIONS -->
<section class="py-5 bg-white">
  <h2 class="text-center text-3xl font-extrabold text-gray-700 mb-4">Certifié par :</h2>
  <div class="overflow-hidden max-w-6xl mx-auto px-6">
    <div class="animate-slide flex gap-6">
      @for ($i = 0; $i < 4; $i++) {{-- Répéter pour remplir le slide avec 4 logos --}}
        @for ($j =1; $j <= 4; $j++) {{-- 4 logos disponibles --}}
          <img src="{{ asset('images/certifications/cert' . $j . '.png') }}"
               alt="Certification {{ $j }}"
               class="h-20 object-contain   transition duration-300" />
        @endfor
      @endfor
    </div>
  </div>
</section>

<!-- Section Carte -->
<section id="map" class="py-16 bg-gray-100">
  <div class="max-w-7xl mx-auto px-6">
    <h2 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Notre localisation</h2>
    <div class="w-full h-96 rounded-lg shadow-lg overflow-hidden">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3360.862617499514!2d-9.523189184848366!3d30.39697918179467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3c90004c983df%3A0x97211cd54a47ae46!2sHYGIEXPERT%205D%20%2F%20DERATISATION-DESINSECTISATION-DESINFECTION%20AGADIR!5e0!3m2!1sfr!2sma!4v1685038473215!5m2!1sfr!2sma"
        width="100%"
        height="100%"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </div>
  </div>
</section>

<section id="boutique" class="bg-white py-20 px-4 border-t border-gray-200">
  <div class="max-w-7xl mx-auto text-center mb-10">
    <h2 class="text-4xl font-bold text-gray-800 mb-4">Notre Boutique en Ligne</h2>
    <p class="text-lg text-gray-600">
      Découvrez tous nos produits et services sur notre boutique officielle.
    </p>
  </div>

  <div class="max-w-7xl mx-auto">
    <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-300 mb-8">
      <iframe
        src="https://hygiexpert5d.com"
        class="w-full h-[600px]"
        frameborder="0"
      ></iframe>
    </div>

    <!-- Bouton vers le site -->
    <div class="text-center">
      <a href="https://hygiexpert5d.com" target="_blank" rel="noopener noreferrer" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition duration-300">
        Accéder à la Boutique
      </a>
    </div>
  </div>
</section>






  <!-- Login Section -->
  <section id="login"  class="mx-2 flex flex-col bg-gray-50 py-12 flex-grow flex items-center justify-center  bg-gray-50" >
  <div class="text-center mb-10">
      
      <h2 class="text-4xl font-bold text-gray-800">Connexion Client</h2>
      <p class="text-gray-600 mt-2">Accédez à votre espace personnel</p>
    </div>

    <div class="w-full max-w-6xl bg-white rounded-xl shadow-blue-300 shadow-2xl grid grid-cols-1 md:grid-cols-2 overflow-hidden">
      
      <!-- Image côté gauche (visible sur md et plus) -->
      <div 
        class="hidden md:block bg-cover bg-center" 
        style="background-image: url('{{ asset('images/bg-login.jpg') }}');"
        aria-hidden="true"
      ></div>
      
      <!-- Formulaire de connexion côté droit -->
      <div class="p-8 sm:p-10 flex flex-col justify-center">
        
        <div class="flex justify-center mb-6">
          <img src="{{ asset('images/favicon.png') }}" alt="Logo" class="w-[120px] h-auto" />
        </div>
        
        

        <!-- Nouveau titre H2 ajouté -->
        <div class="text-center mb-6">
          <h2 class="text-xl font-semibold text-gray-700">Bienvenue chez HYGIEXPERT 5D</h2>
        </div>

        @if ($errors->any())
          <div class="mb-6 p-4 bg-red-100 text-red-700 rounded">
            @foreach ($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif

        <form method="POST" action="{{ route('client.login') }}">
  @csrf
  <div class="mb-5">
    <label for="email" class="block text-sm font-medium text-gray-700">Adresse email *</label>
    <input type="email" id="email" name="email" value="{{ old('email', request()->cookie('remember_email')) }}" required
      class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" />
  </div>
  <div class="mb-5">
    <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
    <input type="password" id="password" name="password" required 
      class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500" />
  </div>
  <div class="flex items-center mb-6">
    <input
        type="checkbox"
        id="remember"
        name="remember"
        class="w-4 h-4 text-indigo-600 border-gray-300 rounded"
        {{ old('remember') || request()->cookie('remember_email') ? 'checked' : '' }}
    >
    <label for="remember" class="ml-2 text-sm text-gray-600">Se souvenir de moi</label>
</div>
  <button type="submit"
    class="btn-3d w-full text-white py-3 rounded-md text-lg font-semibold focus:outline-none focus:ring-4 focus:ring-indigo-300">
    Se connecter
  </button>
</form>
      </div>
    </div>
  </main>
</section>




  <!-- Footer -->
<!-- filepath: /Users/yassineakazi/Desktop/hegyexpret5d/clientproject/resources/views/admin/clients/login.blade.php -->
<footer class="bg-white from-gray-900 to-gray-800 text-black-300 mt-12">
  <div class="max-w-7xl mx-auto px-4 py-12">
    <!-- Top Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
      <!-- Company Info -->
      <div class="space-y-4">
        <div class="flex items-center space-x-3">
          <img src="{{ asset('images/logo.png') }}" alt="Logo HYGIEXPERT 5D" class=" h-auto rounded-lg bg-white p-2" />
          
        </div>
        <p class="text-sm">Leader en solutions d'hygiène et de contrôle des nuisibles au Maroc.</p>
      </div>

      <!-- Quick Links -->
      <div>
        <h3 class="text-black font-semibold mb-4">Liens Rapides</h3>
        <ul class="space-y-2">
          <li><a href="#about" class="hover:text-blue-400 transition-colors duration-300">À propos</a></li>
          <li><a href="#services" class="hover:text-blue-400  transition-colors duration-300">Services</a></li>
          <li><a href="#login" class="hover:text-blue-400  transition-colors duration-300">Espace Client</a></li>
          <li><a href="#boutique" class="text-gray-700 hover:text-indigo-600 font-medium">Boutique</a></li>
          <li><a href="#map" class="text-gray-700 hover:text-indigo-600 font-medium">Localisation</a></li>
          
          
        </ul>
      </div>

      <!-- Services -->
      <div>
        <h3 class="text-black font-semibold mb-4"><a href="#services">Nos Services</a></h3>
        <ul class="space-y-2">
          <li>Dératisation</li>
          <li>Désinsectisation</li>
          <li>Désinfection</li>
          <li>Dépigeonnage</li>
          <li>Dérptilisation
          </li>

        </ul>
      </div>

      <!-- Contact -->
      <div class="space-y-4 ">
        <h3 class="text-black font-semibold mb-4">Contact</h3>
        <ul class="space-y-2">
          <li class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
            <a href="mailto:contact@hygiexpert5d.com" class="hover:text-blue-400 transition-colors duration-300">contact@hygiexpert5d.com</a>
          </li>
          <li class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone-call-icon lucide-phone-call"><path d="M13 2a9 9 0 0 1 9 9"/><path d="M13 6a5 5 0 0 1 5 5"/><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>
            <a href="tel:+2120677864237" class="hover:text-blue-400 transition-colors duration-300">06 77 86 42 37</a>
          </li>
          <li class="flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headset-icon lucide-headset"><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/></svg>
            <a href="tel:+2120528288588" class="hover:text-blue-400 transition-colors duration-300">05 28 28 85 88</a>
          </li>
          <li class="flex items-center space-x-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
            <a target="_blank" rel="noopener noreferrer" href="https://hygiexpert5d.com/" class="hover:text-blue-400 transition-colors duration-300">Notre Store</a>
          </li>
        </ul>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="pt-8 border-t border-gray-700">
      <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
        <!-- Copyright -->
        <div class="text-sm">
          © 2025 HYGIEXPERT 5D. Tous droits réservés.
        </div>

        <!-- Social Links -->
        <div class="flex space-x-6">
          <a target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/people/Hygiexpert-5D/61570946841424/?rdid=klKEu12DgWmHhPoW&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2F1DD8YPJndH%2F" class="hover:text-blue-400 transition-colors duration-300">
            <span class="sr-only">Facebook</span>
            <svg  class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
    <path d="M25,3C12.85,3,3,12.85,3,25c0,11.03,8.125,20.137,18.712,21.728V30.831h-5.443v-5.783h5.443v-3.848 c0-6.371,3.104-9.168,8.399-9.168c2.536,0,3.877,0.188,4.512,0.274v5.048h-3.612c-2.248,0-3.033,2.131-3.033,4.533v3.161h6.588 l-0.894,5.783h-5.694v15.944C38.716,45.318,47,36.137,47,25C47,12.85,37.15,3,25,3z"></path>
</svg>
          </a>

          <a href="https://www.instagram.com/hygiexpert.5d/" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400 transition-colors duration-300">
            <span class="sr-only">Instagram</span>
            <svg  class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 64 64">
<path d="M 21.580078 7 C 13.541078 7 7 13.544938 7 21.585938 L 7 42.417969 C 7 50.457969 13.544938 57 21.585938 57 L 42.417969 57 C 50.457969 57 57 50.455062 57 42.414062 L 57 21.580078 C 57 13.541078 50.455062 7 42.414062 7 L 21.580078 7 z M 47 15 C 48.104 15 49 15.896 49 17 C 49 18.104 48.104 19 47 19 C 45.896 19 45 18.104 45 17 C 45 15.896 45.896 15 47 15 z M 32 19 C 39.17 19 45 24.83 45 32 C 45 39.17 39.169 45 32 45 C 24.83 45 19 39.169 19 32 C 19 24.831 24.83 19 32 19 z M 32 23 C 27.029 23 23 27.029 23 32 C 23 36.971 27.029 41 32 41 C 36.971 41 41 36.971 41 32 C 41 27.029 36.971 23 32 23 z"></path>
</svg>
          </a>

          <a href="https://www.tiktok.com/@hygiexpert.5d?_t=ZM-8tEEAB8GCNa&_r=1" target="_blank" rel="noopener noreferrer" class="hover:text-blue-400 transition-colors duration-300">
            <span class="sr-only">TikTok</span>
            <svg class="w-6 h-6 " xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 50 50">
              <path d="M41,4H9C6.243,4,4,6.243,4,9v32c0,2.757,2.243,5,5,5h32c2.757,0,5-2.243,5-5V9C46,6.243,43.757,4,41,4z M37.006,22.323 c-0.227,0.021-0.457,0.035-0.69,0.035c-2.623,0-4.928-1.349-6.269-3.388c0,5.349,0,11.435,0,11.537c0,4.709-3.818,8.527-8.527,8.527 s-8.527-3.818-8.527-8.527s3.818-8.527,8.527-8.527c0.178,0,0.352,0.016,0.527,0.027v4.202c-0.175-0.021-0.347-0.053-0.527-0.053 c-2.404,0-4.352,1.948-4.352,4.352s1.948,4.352,4.352,4.352s4.527-1.894,4.527-4.298c0-0.095,0.042-19.594,0.042-19.594h4.016 c0.378,3.591,3.277,6.425,6.901,6.685V22.323z"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- Bouton WhatsApp flottant -->

<div class="fixed bottom-6 right-6 flex flex-col items-end space-y-4 z-50">
 

  <!-- Bouton WhatsApp avec SVG plus petit -->
  <a href="https://wa.me/212677864237" target="_blank" rel="noopener noreferrer" 
     class="p-3 bg-green-500 rounded-full shadow-lg hover:bg-green-600 transition"
     aria-label="Contact WhatsApp">
     <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0 0 48 48" class="w-8 h-8    ">
<path fill="#fff" d="M4.9,43.3l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5c5.1,0,9.8,2,13.4,5.6C41,14.2,43,18.9,43,24	c0,10.5-8.5,19-19,19c0,0,0,0,0,0h0c-3.2,0-6.3-0.8-9.1-2.3L4.9,43.3z"></path><path fill="#fff" d="M4.9,43.8c-0.1,0-0.3-0.1-0.4-0.1c-0.1-0.1-0.2-0.3-0.1-0.5L7,33.5c-1.6-2.9-2.5-6.2-2.5-9.6	C4.5,13.2,13.3,4.5,24,4.5c5.2,0,10.1,2,13.8,5.7c3.7,3.7,5.7,8.6,5.7,13.8c0,10.7-8.7,19.5-19.5,19.5c-3.2,0-6.3-0.8-9.1-2.3	L5,43.8C5,43.8,4.9,43.8,4.9,43.8z"></path><path fill="#cfd8dc" d="M24,5c5.1,0,9.8,2,13.4,5.6C41,14.2,43,18.9,43,24c0,10.5-8.5,19-19,19h0c-3.2,0-6.3-0.8-9.1-2.3L4.9,43.3	l2.7-9.8C5.9,30.6,5,27.3,5,24C5,13.5,13.5,5,24,5 M24,43L24,43L24,43 M24,43L24,43L24,43 M24,4L24,4C13,4,4,13,4,24	c0,3.4,0.8,6.7,2.5,9.6L3.9,43c-0.1,0.3,0,0.7,0.3,1c0.2,0.2,0.4,0.3,0.7,0.3c0.1,0,0.2,0,0.3,0l9.7-2.5c2.8,1.5,6,2.2,9.2,2.2	c11,0,20-9,20-20c0-5.3-2.1-10.4-5.8-14.1C34.4,6.1,29.4,4,24,4L24,4z"></path><path fill="#40c351" d="M35.2,12.8c-3-3-6.9-4.6-11.2-4.6C15.3,8.2,8.2,15.3,8.2,24c0,3,0.8,5.9,2.4,8.4L11,33l-1.6,5.8l6-1.6l0.6,0.3	c2.4,1.4,5.2,2.2,8,2.2h0c8.7,0,15.8-7.1,15.8-15.8C39.8,19.8,38.2,15.8,35.2,12.8z"></path><path fill="#fff" fill-rule="evenodd" d="M19.3,16c-0.4-0.8-0.7-0.8-1.1-0.8c-0.3,0-0.6,0-0.9,0s-0.8,0.1-1.3,0.6c-0.4,0.5-1.7,1.6-1.7,4	s1.7,4.6,1.9,4.9s3.3,5.3,8.1,7.2c4,1.6,4.8,1.3,5.7,1.2c0.9-0.1,2.8-1.1,3.2-2.3c0.4-1.1,0.4-2.1,0.3-2.3c-0.1-0.2-0.4-0.3-0.9-0.6	s-2.8-1.4-3.2-1.5c-0.4-0.2-0.8-0.2-1.1,0.2c-0.3,0.5-1.2,1.5-1.5,1.9c-0.3,0.3-0.6,0.4-1,0.1c-0.5-0.2-2-0.7-3.8-2.4	c-1.4-1.3-2.4-2.8-2.6-3.3c-0.3-0.5,0-0.7,0.2-1c0.2-0.2,0.5-0.6,0.7-0.8c0.2-0.3,0.3-0.5,0.5-0.8c0.2-0.3,0.1-0.6,0-0.8	C20.6,19.3,19.7,17,19.3,16z" clip-rule="evenodd"></path>
</svg>
  </a>
</div>


  <script>
  let currentSlide = 0;
  const slider = document.getElementById('heroSlider');
  const slides = slider.children;
  const totalSlides = slides.length;

  setInterval(() => {
    currentSlide = (currentSlide + 1) % totalSlides;
    slider.style.transform = `translateX(-${currentSlide * 100}%)`;
  }, 5000); // change every 5 seconds

  document.addEventListener('DOMContentLoaded', function () {
    // Coordonnées HYGIEXPERT 5D (exemple : Agadir, Maroc)
    var lat = 30.427755;
    var lon = -9.598107;

    var map = L.map('mapid').setView([lat, lon], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
      .bindPopup('HYGIEXPERT 5D - Notre siège')
      .openPopup();
  });

  document.getElementById('menu-toggle').addEventListener('click', function () {
    const menu = document.getElementById('mobile-menu');
    menu.classList.toggle('hidden');
  });
</script>
</body>
</html>