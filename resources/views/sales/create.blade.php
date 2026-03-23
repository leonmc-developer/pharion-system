<form action="{{ route('sales.store') }}" method="POST">
    @csrf
@if(session('success'))
    <div class="mb-4 p-3 bg-green-500 text-white rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 p-3 bg-red-500 text-white rounded">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-3 bg-yellow-400 text-black rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <select name="product_id" class="w-full border rounded px-3 py-2">
        @forelse($products as $product)
            <option value="{{ $product->id }}"
                {{ old('product_id') == $product->id ? 'selected' : '' }}>
                {{ $product->name }} (Stock: {{ $product->stock }})
            </option>
        @empty
            <option disabled>No hay productos con stock disponible</option>
        @endforelse
    </select>
    <div class="mb-4">
        <p id="stock" class="text-gray-700"></p>
    </div>
    <div class="mb-4">
        <p id="price" class="text-gray-700"></p>
        <p id="total" class="font-bold text-lg"></p>
    </div>

    <div class="mb-4">
        <label class="block font-medium mb-1">Cantidad</label>

        <input type="number" name="quantity"
            value="{{ old('quantity') }}"
            min="1"
            class="w-full border rounded px-3 py-2
            @error('quantity') border-red-500 @enderror">

        @error('quantity')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        disabled
        class="bg-gray-400 text-white px-4 py-2 rounded w-full"
        id="submitBtn">
        Seleccione producto
    </button>
</form>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const products = @json($products);

    const select = document.querySelector('select[name="product_id"]');
    const quantityInput = document.querySelector('input[name="quantity"]');

    const priceEl = document.getElementById('price');
    const totalEl = document.getElementById('total');
    const stockEl = document.getElementById('stock');
    const button = document.getElementById('submitBtn');

    function resetState() {
        priceEl.innerText = '';
        totalEl.innerText = '';
        stockEl.innerText = '';
        button.disabled = true;
        button.innerText = 'Seleccione producto';
    }

    function updateInfo() {
        const product = products.find(p => p.id == select.value);

        if (!product) {
            resetState();
            return;
        }

        const quantity = parseFloat(quantityInput.value) || 0;
        const total = product.price * quantity;

        priceEl.innerText = `Precio: $${Number(product.price).toFixed(2)}`;
        totalEl.innerText = `Total: $${Number(total).toFixed(2)}`;
        stockEl.innerText = `Stock disponible: ${product.stock}`;

        if (quantity <= 0) {
            button.disabled = true;
            button.innerText = "Ingrese cantidad";
            return;
        }

        if (quantity > product.stock) {
            button.disabled = true;
            button.innerText = "Stock insuficiente";
            return;
        }

        button.disabled = false;
        button.innerText = "Registrar Venta";
    }

    select.addEventListener('change', updateInfo);
    quantityInput.addEventListener('input', updateInfo);

    // 🔥 ESTADO INICIAL
    resetState();

});
</script>