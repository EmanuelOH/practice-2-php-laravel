<x-layouts.app>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 600px;">
            <h1 class="text-center">Ingresa</h1>

            <form action="{{ route('auth.login') }}" method="POST" class="needs-validation">
                @csrf

                <div class="row">
                    <div class="mb-3 col">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 col-4 mx-auto">
                    <button type="submit" class="btn btn-primary col">Iniciar Sesión</button>
                    <a href="{{ route('register') }}" class="text-center">¿No tienes cuenta? Regístrate</a>
                </div>
            </form>
        </div>
    </section>
</x-layouts.app>
