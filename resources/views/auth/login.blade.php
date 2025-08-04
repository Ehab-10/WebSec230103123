<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

       <div class="mt-4 text-center">
    <span class="text-sm text-gray-500">Don't have an account?</span>
    <a href="{{ route('register') }}" class="text-sm text-blue-500 hover:underline">
        Register here
    </a>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-3">
        <a href="{{ url('/login/facebook') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
            <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M22,12A10,10 0 1,0 12,22A10,10 0 0,0 22,12M15.5,12H13V18H10V12H8.5V9.5H10V8.25C10,6.76 10.9,5 13,5H15.5V7.5H14C13.17,7.5 13,7.88 13,8.5V9.5H15.5V12Z" /></svg>
            Login with Facebook
        </a>

        <a href="{{ url('/login/microsoft') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
            <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M3 3h8v8H3V3m10 0h8v8h-8V3m0 10h8v8h-8v-8m-10 0h8v8H3v-8z" /></svg>
            Login with Microsoft
        </a>

        <a href="{{ url('/login/linkedin') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
            <svg class="w-5 h-5 mr-2 fill-current" viewBox="0 0 24 24"><path d="M19 3A2 2 0 0 1 21 5V19A2 2 0 0 1 19 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H19M8.34 17.34V10.67H5.67V17.34H8.34M7 9.33A1.33 1.33 0 1 0 7 6.67A1.33 1.33 0 0 0 7 9.33M18.33 17.34V13.5C18.33 11.67 17 10.5 15.34 10.5C14.26 10.5 13.5 11.17 13.17 11.72V10.67H10.5V17.34H13.17V13.78C13.17 13 13.84 12.5 14.5 12.5C15.17 12.5 15.67 13 15.67 13.78V17.34H18.33Z" /></svg>
            Login with LinkedIn
        </a>

        <a href="{{ url('/login/google') }}"
           class="inline-flex items-center justify-center px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium rounded-md shadow-sm transition duration-150">
    <svg class="w-5 h-5 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
        <path fill="#fff" d="M533.5 278.4c0-17.4-1.6-34.1-4.6-50.3H272v95.2h146.7c-6.3 34-25.1 62.7-53.5 81.7v67h86.2c50.5-46.5 82.1-115.1 82.1-193.6z"/>
        <path fill="#fff" d="M272 544.3c71.6 0 131.7-23.7 175.6-64.3l-86.2-67c-24.3 16.3-55.5 25.8-89.4 25.8-68.9 0-127.3-46.5-148.2-109.1H36.3v68.7c43.8 86.5 134.7 145.9 235.7 145.9z"/>
        <path fill="#fff" d="M123.8 329.7c-10.4-30.8-10.4-64.1 0-94.9V166h-87.5c-35.2 69.3-35.2 151.9 0 221.2l87.5-57.5z"/>
        <path fill="#fff" d="M272 107.1c38.9 0 73.7 13.4 101.3 39.5l75.9-75.9C379.1 24.7 324.3 0 272 0 170.9 0 80 59.4 36.3 145.9l87.5 68.7c20.9-62.6 79.3-107.5 148.2-107.5z"/>
    </svg>
    Login with Google
</a>

    </div>
</div>


    </form>
</x-guest-layout>
