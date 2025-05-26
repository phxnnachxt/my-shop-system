<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">ข้อมูลลูกค้า</h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
        <div class="mb-4">
            <strong>ชื่อ:</strong> {{ $customer->name }}
        </div>
        <div class="mb-4">
            <strong>เบอร์โทรศัพท์:</strong> {{ $customer->phone ?? '-' }}
        </div>

        <a href="{{ route('customers.edit', $customer) }}" 
           class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 mr-2">
           แก้ไข
        </a>
        <a href="{{ route('customers.index') }}" 
           class="inline-block bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
           กลับสู่รายชื่อ
        </a>
    </div>
</x-app-layout>
