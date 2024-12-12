<x-layouts.app>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow-lg" style="width: 100%; max-width: 600px;">

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary position-absolute" style="top: -45px; left: 10px;">Volver</a>

            <h1 class="mb-4 text-center">Detalles del usuario</h1>

            @if(session('success'))
                <div class="alert alert-success mb-4 text-sm text-green-700 bg-green-100 border-l-4 border-green-500 p-3 rounded">
                    <strong>Bien hecho!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="mb-3 col">
                    <label for="names" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="names" name="names" value="{{ old('names', $user->names ?? '') }}" disabled>
                </div>

                <div class="mb-3 col">
                    <label for="lastnames" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="lastnames" name="lastnames" value="{{ old('lastnames', $user->lastnames ?? '') }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" disabled>
                </div>

                <div class="mb-3 col">
                    <label for="gender" class="form-label">Género</label>
                    <input type="text" class="form-control" id="gender" name="gender" value="{{ old('gender', $user->gender ?? '') }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" disabled>
                </div>

                <div class="mb-3 col">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label for="country_id" class="form-label">País</label>
                <input type="text" class="form-control" id="country_id" name="country_id" value="{{ $user->country->name }}" disabled>
            </div>

            <div class="d-flex">
                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-primary">Editar</a>
            </div>

        </div>
    </section>
</x-layouts.app>
