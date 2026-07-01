<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-pink-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-pink-500">
            
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                    <input id="name" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="text" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mt-4">
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                    <input id="password" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="password" name="password" required>
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="password" name="password_confirmation" required>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4 underline">
                        Already registered?
                    </a>
                    
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 transition ease-in-out duration-150">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>