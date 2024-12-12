<x-layouts.app>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-2xl">Lista de Usuarios</h1>
            
            <div class="d-flex justify-content-between">
                <span class="badge bg-primary text-white rounded-circle fs-2 px-2 py-2.5 mx-auto">
                    {{ substr(Auth::user()->names, 0, 1) }}{{ substr(Auth::user()->lastnames, 0, 1) }}
                </span>
                <p class="">Bienvenido, {{ Auth::user()->names }}</p>
            </div>

            <form action="{{ route('usuarios.index') }}" method="GET" class="d-flex">
                <div class="form-control ">
                    <input type="text" class="rounded-lg me-2" name="search" placeholder="Buscar por usuario" value="{{ request()->get('search') }}">
    
                    <button class="btn btn-outline-primary " type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
    
                    @if(request()->get('search') != null)
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Limpiar
                    </a>
                    @endif
                </div>
            </form>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
        
        <div>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Crear Usuario
            </a>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
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
                                <a href="{{ route('usuarios.show', $user->id) }}" class="btn btn-info btn-sm">Detalles</a>
                                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-center">
            <p>{{$users->count()}} usuarios</p>
        </div>

        @if(request()->get('search') == null)
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
        
    </div>
</x-layouts.app>
