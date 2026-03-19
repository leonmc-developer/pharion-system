<h1>Lista de Usuarios</h1>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No hay usuarios</td>
            </tr>
        @endforelse
    </tbody>
</table>