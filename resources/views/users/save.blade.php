<x-layouts.app>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 600px;">

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary position-absolute" style="top: -45px; left: 10px;">Volver</a>

            <h1 class="mb-4 text-center">{{ isset($user->id) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>

            @if(session('success'))
                <div class="alert alert-success mb-4 text-sm text-green-700 bg-green-100 border-l-4 border-green-500 p-3 rounded">
                    <strong>Bien hecho!</strong> {{ session('success') }}
                </div>
            @endif

            <form action="{{ isset($user->id) ? route('usuarios.update', $user->id) : route('usuarios.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @if(isset($user->id))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="mb-3 col">
                        <label for="names" class="form-label">Nombres</label>
                        <input type="text" class="form-control @error('names') is-invalid @enderror" id="names" name="names" value="{{ old('names', $user->names ?? '') }}" required>
                        @error('names')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="lastnames" class="form-label">Apellidos</label>
                        <input type="text" class="form-control @error('lastnames') is-invalid @enderror" id="lastnames" name="lastnames" value="{{ old('lastnames', $user->lastnames ?? '') }}" required>
                        @error('lastnames')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="gender" class="form-label">Género</label>
                        <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                            <option value="">Selecciona un Género</option>
                            <option value="masculino" {{ old('gender', $user->gender ?? '') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('gender', $user->gender ?? '') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('gender', $user->gender ?? '') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="country_id" class="form-label">País</label>
                    <select class="form-select @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                        <option value="">Selecciona un País</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}" {{ old('country_id', $user->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('country_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(!isset($user->id))
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
                @endif

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary w-100">{{ isset($user->id) ? 'Actualizar Usuario' : 'Crear Usuario' }}</button>
                </div>

            </form>
        </div>
    </section>
</x-layouts.app>
