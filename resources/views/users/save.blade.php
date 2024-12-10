<x-layouts.app>
    <div class="container mt-4">
        <h1 class="text-2xl mb-4">{{ isset($user->id) ? 'Editar Usuario' : 'Crear Usuario' }}</h1>

        @if(session('success'))
            <div class="alert alert-success mb-4 text-sm text-green-700 bg-green-100 border-l-4 border-green-500 p-3 rounded">
                <strong>Bien hecho!</strong> {{ session('success') }}
            </div>
        @endif

        <form action="{{ isset($user->id) ? route('usuarios.update', $user->id) : route('usuarios.store') }}" method="POST" class="space-y-4">
            @csrf
            @if(isset($user->id))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="names" class="form-label">Nombres</label>
                <input type="text" class="form-control @error('names') is-invalid @enderror" id="names" name="names" value="{{ old('names', $user->names ?? '') }}" required>
                @error('names')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="lastnames" class="form-label">Apellidos</label>
                <input type="text" class="form-control @error('lastnames') is-invalid @enderror" id="lastnames" name="lastnames" value="{{ old('lastnames', $user->lastnames ?? '') }}" required>
                @error('lastnames')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="country_id" class="form-label">País</label>
                <select class="form-select @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                    <option value="">Selecciona un País</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                @error('country_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="gender" class="form-label">Género</label>
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="">Selecciona un Género</option>
                    <option value="masculino" {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Masculino</option>
                    <option value="femenino" {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Femenino</option>
                    <option value="otro" {{ old('gender', $user->gender ?? '') == 'other' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Teléfono</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Dirección</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                    <button type="submit" class="btn btn-primary bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full">{{ isset($user->id) ? 'Actualizar usuario' : 'Crear usuario' }}</button>
                    
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-full">Cancelar</a>
            </div>
        </form>
    </div>
</x-layouts.app>
