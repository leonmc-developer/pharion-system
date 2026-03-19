<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuarios
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Nombre</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Rol</th>
                            <th class="text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td class="flex gap-2 items-center">
                                    <!-- Ver -->
                                    <a href="{{ route('users.show', $user) }}" class="text-blue-500">
                                        Ver
                                    </a>
                                    <!-- Editar -->
                                    <a href="{{ route('users.edit', $user) }}" class="text-yellow-500">
                                        Editar
                                    </a>
                                    <!-- Eliminar -->
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-500">
                                            Desactivar
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay usuarios</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
