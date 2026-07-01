<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Delete Account') }}</h2>
    </header>
    <form method="post" action="{{ route('profile.destroy') }}" class="mt-6 space-y-6">
        @csrf
        @method('delete')
        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete Account</button>
    </form>
</section>