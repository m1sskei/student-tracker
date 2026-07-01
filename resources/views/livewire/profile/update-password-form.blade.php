<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">{{ __('Update Password') }}</h2>
    </header>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded">Update Password</button>
    </form>
</section>