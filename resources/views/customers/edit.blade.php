<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">แก้ไขลูกค้า</h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
        <form method="POST" action="{{ route('customers.update', $customer) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">ชื่อ</label>
                <input id="name" name="name" type="text" required
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    value="{{ old('name', $customer->name) }}">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block font-medium text-gray-700">เบอร์โทรศัพท์</label>
                <input id="phone" name="phone" type="text"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    value="{{ old('phone', $customer->phone) }}">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                บันทึกข้อมูล
            </button>
        </form>
    </div>
</x-app-layout>
