<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Order #{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('orders.update', $order->id) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                <select name="customer_id" id="customer_id" class="mt-1 block w-full rounded border-gray-300" required>
                    <option value="">-- Select Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Order Items</label>
                <table class="w-full border border-gray-300 rounded mb-2">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-3 py-2 text-left text-sm">Drink</th>
                            <th class="border px-3 py-2 text-left text-sm">Quantity</th>
                            <th class="border px-3 py-2 text-right text-sm">Price</th>
                            <th class="border px-3 py-2 text-center text-sm">Remove</th>
                        </tr>
                    </thead>
                    <tbody id="order-items-body">
                        @foreach ($order->orderItems as $item)
                            <tr>
                                <td class="border px-3 py-2">
                                    <select name="drinks[]" required class="drink-select w-full rounded border-gray-300" onchange="updatePrice(this)">
                                        <option value="">-- Select Drink --</option>
                                        @foreach ($drinks as $drink)
                                            <option value="{{ $drink->id }}" data-price="{{ $drink->price }}"
                                                {{ $drink->id == $item->drink_id ? 'selected' : '' }}>
                                                {{ $drink->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="border px-3 py-2">
                                    <input type="number" name="quantities[]" min="1" required
                                        class="quantity-input w-full rounded border-gray-300"
                                        value="{{ $item->quantity }}" onchange="updatePrice(this)">
                                </td>
                                <td class="border px-3 py-2 text-right align-middle">
                                    <span class="item-price text-gray-800 font-semibold">
                                        {{ number_format(($item->drink->price ?? 0) * $item->quantity, 2) }}
                                    </span>
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <button type="button" onclick="removeRow(this)"
                                        class="text-red-600 hover:text-red-900 font-bold">X</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="button" onclick="addRow()"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + Add Item
                </button>

                <div class="text-right mt-4 text-lg font-semibold">
                    Total: <span id="total-price" class="text-blue-600">0.00</span>
                </div>
            </div>

            <div class="flex justify-end space-x-4 mt-4">
                <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>

    <script>
        const drinks = @json($drinks);

        function updatePrice(el) {
            const row = el.closest('tr');
            const drinkSelect = row.querySelector('.drink-select');
            const quantityInput = row.querySelector('.quantity-input');
            const priceSpan = row.querySelector('.item-price');

            const drink = drinks.find(d => d.id == drinkSelect.value);
            const price = drink ? drink.price : 0;
            const quantity = parseInt(quantityInput.value || 0);
            const total = price * quantity;

            priceSpan.textContent = total.toFixed(2);
            updateTotalPrice();
        }

        function updateTotalPrice() {
            const prices = document.querySelectorAll('.item-price');
            let total = 0;
            prices.forEach(span => {
                total += parseFloat(span.textContent) || 0;
            });
            document.getElementById('total-price').textContent = total.toFixed(2);
        }

        function addRow() {
            const tbody = document.getElementById('order-items-body');
            const tr = document.createElement('tr');

            let options = '<option value="">-- Select Drink --</option>';
            drinks.forEach(drink => {
                options += `<option value="${drink.id}" data-price="${drink.price}">${drink.name}</option>`;
            });

            tr.innerHTML = `
                <td class="border px-3 py-2">
                    <select name="drinks[]" required class="drink-select w-full rounded border-gray-300" onchange="updatePrice(this)">
                        ${options}
                    </select>
                </td>
                <td class="border px-3 py-2">
                    <input type="number" name="quantities[]" min="1" required class="quantity-input w-full rounded border-gray-300" value="1" onchange="updatePrice(this)">
                </td>
                <td class="border px-3 py-2 text-right align-middle">
                    <span class="item-price text-gray-800 font-semibold">0.00</span>
                </td>
                <td class="border px-3 py-2 text-center">
                    <button type="button" onclick="removeRow(this)" class="text-red-600 hover:text-red-900 font-bold">ลบรายการ</button>
                </td>
            `;
            tbody.appendChild(tr);
        }

        function removeRow(button) {
            button.closest('tr').remove();
            updateTotalPrice();
        }

        // Initial price calculation
        document.querySelectorAll('.drink-select, .quantity-input').forEach(el => updatePrice(el));
    </script>
</x-app-layout>
