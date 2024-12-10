<x-layouts.app>
    <div class="container mt-5">
        <h1 class="text-center mb-4">{{ $user->names }} {{ $user->lastnames }}</h1>

        <div class="card shadow-lg p-4">
            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Nombre Completo:</strong> {{ $user->names }} {{ $user->lastnames }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Correo Electrónico:</strong> {{ $user->email }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Género:</strong>
                        @if($user->gender == 'male')
                            Masculino
                        @elseif($user->gender == 'female')
                            Femenino
                        @else
                            Otro
                        @endif
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teléfono:</strong> {{ $user->phone }}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p><strong>Dirección:</strong> {{ $user->address }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>País:</strong> {{ $user->country->name ?? 'No disponible' }}</p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver a la lista</a>
            </div>
        </div>
    </div>
</x-layouts.app>
