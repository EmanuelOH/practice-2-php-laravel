<x-layouts.app>
    <section class="container mt-4">
        <h1 class="h1 text-center mb-5">Lista de Usuarios</h1>

        <div class="d-flex justify-content-between align-items-center mb-4">
            
            <a href="{{ route('usuarios.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Crear Usuario
            </a>
    
            <div class="d-flex justify-content-center align-items-center mb-3">
                <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex align-items-center">
                    <input type="text" class="form-control me-2" name="search" placeholder="Buscar por usuario" value="{{ request()->get('search') }}">
                    <button class="btn btn-primary me-2" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    @if(request()->get('search') != null)
                        <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Limpiar
                        </a>
                    @endif
                </form>
    
            </div>

            <div>
                <x-layouts.nav-bar />
            </div>
        </div>
       

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>País</th>
                                <th>Género</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->names }}</td>
                                    <td>{{ $user->lastnames }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->country->name ?? 'Sin asignar' }}</td>
                                    <td>{{ $user->gender ?? 'Sin asignar' }}</td>
                                    <td>{{ $user->phone ?? 'Sin asignar' }}</td>
                                    <td>{{ $user->address ?? 'Sin asignar' }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info btn-sm me-2">Detalles</a>
                                            <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>
                                            <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center me-3 mt-3">
            <div class="d-flex">
                <div class="">
                    {{ $users->links() }}
                </div>
    
                <div class="align-self-center ms-2">
                    <p><strong>{{ $users->count() }}</strong> usuarios</p>
                </div>
            </div>
            
            <div class="text-center my-3">
                <a href="{{ route('usuarios.export') }}" class="btn btn-success btn-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-regular fa-file-excel"></i>
                    <span>Descargar</span>
                </a>
            </div>

        </div>

    </section>
</x-layouts.app>
