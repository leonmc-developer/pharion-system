<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Registrar Compra</h2>

        @if(session('success'))
            <div class="bg-green-200 p-2 mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('purchases.store') }}">
            @csrf

            <select name="product_id" class="border p-2 w-full mb-4">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="quantity" placeholder="Cantidad" class="border p-2 w-full mb-4">

            <input type="date" name="expiration_date" class="border p-2 w-full mb-4">

            <button class="bg-blue-500 text-white px-4 py-2">
                Guardar
            </button>
        </form>
    </div>
</x-app-layout>