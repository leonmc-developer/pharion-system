<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Ventas</h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full border">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->name }}</td>
                        <td>{{ $sale->quantity }}</td>
                        <td>{{ number_format($sale->total, 2) }}</td>
                        <td>{{ $sale->created_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay ventas</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $sales->links() }}
    </div>
</x-app-layout>