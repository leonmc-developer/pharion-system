<x-app-layout>
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-4">Cierre de Caja</h1>

        <form method="GET" class="mb-4">
            <input type="date" name="date" value="{{ $date }}" class="border rounded p-2">
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Filtrar</button>
        </form>

        <div class="mb-4">
            <p><strong>Total ventas:</strong> {{ $count }}</p>
            <p><strong>Total ingresos:</strong> ${{ $total }}</p>
        </div>

        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ $sale->total ?? ($sale->quantity * $sale->product->price) }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @endforeach
                @if($sales->isEmpty())
                    </tr><td colspan="5">No hay ventas para esta fecha</td>
                @endif
            </tbody>
        </table>
<form method="POST" action="{{ route('cash.closing.store') }}">
    @csrf
    <button class="bg-green-500 text-white px-4 py-2 rounded">
        Cerrar Caja
    </button>
</form>
    </div>
</x-app-layout>