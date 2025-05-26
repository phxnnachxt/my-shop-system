<style>
    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-error {
        color: #c40d00;
        background-color: #edd4d4;
        border-color: #e6c3c3;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .btn-actions {
        padding: 5px;
        margin: 5px;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('orders.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                {{ __('+ Add Order') }}
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $order->customer->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * ($item->drink->price ?? 0)), 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">

                                        <form>
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn-actions inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-blue-700 active:bg-blue-900">
                                                {{ __('ดูรายการสินค้า') }}
                                            </a>
                                        </form>

                                        <form>
                                            <a href="{{ route('orders.edit', $order->id) }}"
                                                class="btn-actions inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-indigo-700 active:bg-indigo-900">
                                                {{ __('แก้ไขรายการสินค้า') }}
                                            </a>
                                        </form>

                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-actions inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-red-700 active:bg-red-900">
                                                {{ __('ลบรายการ') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
    
</x-app-layout>
