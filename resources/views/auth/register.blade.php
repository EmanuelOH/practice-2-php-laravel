<x-layouts.app>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 600px;">
            <h1 class="mb-4 text-center">Regístrate</h1>

            <form action="{{ route('auth.register') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <div class="row">
                    <div class="mb-3 col">
                        <label for="names" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('names') is-invalid @enderror" id="names" name="names" value="{{ old('names') }}" required>
                        @error('names')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="lastnames" class="form-label">Apellido</label>
                        <input type="text" class="form-control @error('lastnames') is-invalid @enderror" id="lastnames" name="lastnames" value="{{ old('lastnames') }}" required>
                        @error('lastnames')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="gender" class="form-label">Género</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="masculino" {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('gender') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('gender') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="8">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 col-4 mx-auto">
                    <button type="submit" class="btn btn-primary">Regístrame</button>
                    <a href="{{ route('login') }}" class="text-center">Iniciar Sesión</a>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
