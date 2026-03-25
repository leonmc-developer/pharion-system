<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Registrar Lote</h2>

        @if(session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('batches.store') }}">
            @csrf

            <div class="mb-4">
                <label>Producto</label>
                <select name="product_id" class="border p-2 w-full">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label>Cantidad</label>
                <input type="number" name="quantity" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label>Fecha de vencimiento</label>
                <input type="date" name="expiration_date" class="border p-2 w-full">
            </div>

            <button class="bg-blue-500 text-white px-4 py-2">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>