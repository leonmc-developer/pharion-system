<form action="{{ route('sales.store') }}" method="POST">
    @csrf

    <select name="product_id">
        @foreach($products as $product)
            @forelse($products as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (Stock: {{ $product->stock }})
                </option>
            @empty
                <option disabled>No hay productos con stock disponible</option>
            @endforelse
        @endforeach
    </select>

    <input type="number" name="quantity" min="1">

    <button type="submit">Vender</button>
</form>