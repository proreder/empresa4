<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
                
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mt-4">
                <div class="input-group-text bg-info">
                    <img
                        src="public/vendor/adminlte/dist/img/username-icon.svg"
                        alt="username-icon"
                        style="height: 1rem"
                    />
                </div>
               <!-- <x-label for="email" value="{{ __('Email') }}" />-->
                <input id="email" class="form-control bg-light" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Email"/>
            </div>

            <div class="input-group mt-4">
                <!-- <x-label for="password" value="{{ __('Password') }}" />-->
                <div class="input-group-text bg-info">
                    <img
                        src="public/vendor/adminlte/dist/img/password-icon.svg"
                        alt="username-icon"
                        style="height: 1rem"
                    />
                </div>
                <x-input id="password" class="form-control bg-light" type="password" name="password" required autocomplete="current-password" placeholder="password"  />
            </div>
            <x-validation-errors class="mb-4" />
            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <!--
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                -->
                <x-button class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
@section('css')
    <link rel="stylesheet" href="../public/build/assest/boostrap5.css">
    
@stop

@section('js')
    <script src="../public/build/assest/boostrap5.js"></script>
@stop


