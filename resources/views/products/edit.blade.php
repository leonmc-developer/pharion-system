<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Producto</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium mb-1" for="name">Nombre</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-1" for="price">Precio</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                        step="0.01" class="w-full border border-gray-300 rounded px-3 py-2">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block font-medium mb-1" for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                        class="w-full border border-gray-300 rounded px-3 py-2">

                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('products.index') }}"
                        class="px-4 py-2 mr-2 border rounded hover:bg-gray-100">Cancelar</a>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">Actualizar</button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
