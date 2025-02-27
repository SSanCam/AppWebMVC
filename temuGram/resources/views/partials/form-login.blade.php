<form class="auth__form {{ $errors->any() ? 'auth__form-error' : '' }}" action="{{ url('/login') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="text" id="email" name="email" placeholder="Ingresa tu correo">
        @error('email') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
        @error('password') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </div>
</form>
