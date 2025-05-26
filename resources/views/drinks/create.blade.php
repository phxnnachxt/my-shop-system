<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            เพิ่มเครื่องดื่มใหม่
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            <form method="POST" action="{{ route('drinks.store') }}">
                @csrf

                <!-- ชื่อเครื่องดื่ม -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">ชื่อเครื่องดื่ม</label>
                    <input id="name" name="name" type="text" required
                        class="w-full px-3 py-2 border border-gray-300 rounded"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ราคาสินค้า -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2">ราคา</label>
                    <input id="price" name="price" type="number" step="0.01" min="0" required
                        class="w-full px-3 py-2 border border-gray-300 rounded"
                        value="{{ old('price') }}">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        เพิ่มเครื่องดื่ม
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
