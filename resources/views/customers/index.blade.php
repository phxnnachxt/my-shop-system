<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">รายชื่อลูกค้า</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif

            <a href="{{ route('customers.create') }}" 
               class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
               + เพิ่มลูกค้า
            </a>

            <div class="bg-white shadow rounded-lg p-6">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">ชื่อ</th>
                            <th class="border border-gray-300 px-4 py-2">เบอร์โทรศัพท์</th>
                            <th class="border border-gray-300 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $customer->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $customer->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $customer->phone ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('customers.show', $customer) }}"
                                   class="inline-block px-3 py-1 bg-gray-800 text-white rounded hover:bg-gray-700 mr-1">ดู</a>
                                <a href="{{ route('customers.edit', $customer) }}"
                                   class="inline-block px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-500 mr-1">แก้ไข</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline-block"
                                      onsubmit="return confirm('คุณแน่ใจจะลบลูกค้าคนนี้หรือไม่?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        ลบ
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
