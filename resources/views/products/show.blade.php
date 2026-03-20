<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle Producto</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <div class="mb-4">
                <p class="font-medium">Nombre:</p>
                <p>{{ $product->name }}</p>
            </div>

            <div class="mb-4">
                <p class="font-medium">Precio:</p>
                <p>{{ number_format($product->price, 2) }}</p>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('products.index') }}"
                    class="px-4 py-2 border rounded hover:bg-gray-100">Volver</a>
                <a href="{{ route('products.edit', $product) }}"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 ml-2">Editar</a>
            </div>

        </div>
    </div>
</x-app-layout>