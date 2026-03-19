<x-app-layout>
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>

        {{-- Mensajes de error --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded">
                <ul class="text-red-600 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            {{-- Rol --}}
            <div>
                <label class="block text-sm font-medium">Rol</label>
                <select name="role" class="w-full border rounded px-3 py-2 mt-1" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                    <option value="empleado" {{ $user->role === 'empleado' ? 'selected' : '' }}>
                        Empleado
                    </option>
                </select>
            </div>

            {{-- Botones --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('users.index') }}" class="text-gray-600 hover:underline">
                    ← Volver
                </a>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
