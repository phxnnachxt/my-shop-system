<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">เพิ่มลูกค้าใหม่</h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('customers.store') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">ชื่อ</label>
                <input id="name" name="name" type="text" required
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-medium text-gray-700">เบอร์โทรศัพท์</label>
                <input id="phone" name="phone" type="text"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                เพิ่มลูกค้า
            </button>
        </form>
    </div>
</x-app-layout>
