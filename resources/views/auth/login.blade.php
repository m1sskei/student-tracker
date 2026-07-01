<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-pink-50">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-pink-500">
            
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- DITO ANG IDINAGDAG NATIN PARA SA ERROR -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-600 text-sm rounded border border-red-200">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                    <input id="email" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <div class="mt-4">
                    <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                    <input id="password" class="block mt-1 w-full border-gray-300 focus:border-pink-500 focus:ring-pink-500 rounded-md shadow-sm" type="password" name="password" required autocomplete="current-password">
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 focus:bg-pink-700 active:bg-pink-900 transition ease-in-out duration-150">
                        Log in
                    </button>
                </div>

                <div class="mt-6 border-t pt-4 text-center">
                    <span class="text-sm text-gray-600">Wala ka pang account?</span>
                    <a href="{{ route('register') }}" class="ml-2 inline-flex items-center px-4 py-2 bg-white border border-pink-300 rounded-md font-semibold text-xs text-pink-700 uppercase tracking-widest hover:bg-pink-50 transition ease-in-out duration-150">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>