@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Bienvenue, {{ Auth::guard('client')->user()->nom ?? 'Client' }}</h1>
    <form method="POST" action="{{ route('client.logout') }}">
        @csrf
        <button type="submit"
            class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
            Déconnexion
        </button>
    </form>
</div>
@endsection