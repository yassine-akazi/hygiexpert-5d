<form method="POST" action="{{ route('client.logout') }}">
    @csrf
    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 mt-4">
        Logout
    </button>
</form>