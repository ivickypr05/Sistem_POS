@extends('layouts.authapp')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="form login">
        @csrf
        <div class="form__field">
            <label for="email">
                <i class="bi bi-envelope"></i>
                <span class="hidden">Alamat Email</span>
            </label>
            <div class="input-wrapper">
                <input id="email" type="email" name="email" class="form__input @error('email') is-invalid @enderror"
                    placeholder="Email" required autocomplete="email" autofocus>
                {{-- @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
        </div>


        <div class="form__field">
            <label for="password">
                <i class="bi bi-key-fill"></i>
                <span class="hidden">Alamat password</span>
            </label>
            <div class="input-wrapper">
                <input id="password" type="password" name="password"
                    class="form__input  @error('password') is-invalid @enderror" placeholder="Password" required
                    autocomplete="current-password">
                <i class="bi bi-eye-fill toggle-password"></i>
                {{-- @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror --}}
            </div>
        </div>
        <div class="form__field row">
            <input type="submit" value="Login">
        </div>

    </form>
@endsection

@section('scripts')
    <script>
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye-fill');
            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>
@endsection
