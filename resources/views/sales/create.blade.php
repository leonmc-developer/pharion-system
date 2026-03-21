<form action="{{ route('sales.store') }}" method="POST">
    @csrf

    <select name="product_id">
        @foreach($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->name }} (Stock: {{ $product->stock }})
            </option>
        @endforeach
    </select>

    <input type="number" name="quantity" min="1">

    <button type="submit">Vender</button>
</form>