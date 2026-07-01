<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <label for="name">Name</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="border p-2 w-full" required autofocus>
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="border p-2 w-full" required>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="bg-blue-600 text-white p-2 px-4 rounded">Save</button>

            @if (session('status') === 'profile-updated')
                <p>Saved.</p>
            @endif
        </div>
    </form>
</section>