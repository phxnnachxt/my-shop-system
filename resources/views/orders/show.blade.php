<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm rounded-lg">
        <div class="p-6">
            <p><strong>Customer:</strong> {{ $order->customer->name ?? '-' }}</p>
            <p><strong>Phone:</strong> {{ $order->customer->phone ?? '-' }}</p> <!-- เพิ่มตรงนี้ -->

            <p><strong>Order Items:</strong></p>
            <ul class="list-disc list-inside mb-4">
                @foreach ($order->orderItems as $item)
                    <li>{{ $item->drink->name ?? '-' }} x {{ $item->quantity }} (Price per unit: {{ number_format($item->drink->price ?? 0, 2) }})</li>
                @endforeach
            </ul>
            <p><strong>Total Price:</strong> {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * ($item->drink->price ?? 0)), 2) }}</p>

            <div class="mt-4">
                <a href="{{ route('orders.index') }}" 
                   class="inline-block px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                    {{ __('Back to Orders List') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
