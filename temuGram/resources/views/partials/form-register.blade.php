<form class="auth__form {{ $errors->any() ? 'auth__form-error' : '' }}" action="{{ url('/register') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input class="form-control" type="text" name="name" placeholder="Nombre completo">
        @error('name') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input class="form-control" type="text" name="email" placeholder="Correo electrónico">
        @error('email') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
        @error('password') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña">
        @error('password_confirmation') <small class="auth_form__error">{{ $message }}</small> @enderror
    </div>
    <div class="form-group d-flex justify-content-center gap-3">
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </div>
</form>
