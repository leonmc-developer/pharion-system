<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Listado de Lotes</h2>

        <table class="min-w-full border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Producto</th>
                    <th class="border px-4 py-2">Cantidad</th>
                    <th class="border px-4 py-2">Vencimiento</th>
                </tr>
            </thead>
            <tbody>
               @foreach($batches as $batch)
                    @php
                        $today = \Carbon\Carbon::today();
                        $expiration = \Carbon\Carbon::parse($batch->expiration_date);
                    @endphp

                    <tr class="
                        @if($expiration->lt($today))
                            bg-red-200
                        @elseif($expiration->lte($today->copy()->addDays(30)))
                            bg-yellow-200
                        @endif
                    ">
                        <td class="border px-4 py-2">
                            {{ $batch->product->name }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $batch->quantity }}
                        </td>
                        <td class="border px-4 py-2">
                            {{ $batch->expiration_date }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>