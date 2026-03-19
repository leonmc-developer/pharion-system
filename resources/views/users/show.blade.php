<x-app-layout>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Detalle de Usuario</h1>

        <p><strong>Nombre:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Rol:</strong> {{ $user->role }}</p>

        <a href="{{ route('users.index') }}" class="text-blue-500">Volver</a>
    </div>
</x-app-layout>
