<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Order</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-400 rounded text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf

            <div class="mb-6">
                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                <select name="customer_id" id="customer_id" class="block w-full rounded border-gray-300 shadow-sm" required>
                    <option value="">-- Select Customer --</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
                @error('customer_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <h3 class="text-lg font-medium text-gray-900 mb-3">Drinks</h3>
                <div id="drink-items" class="space-y-4">

                    {{-- รายการเครื่องดื่มเริ่มต้น --}}
                    <div class="drink-item flex space-x-3 items-center">
                        <div class="flex-1">
                            <select name="drinks[]" class="drink-select block w-full rounded border-gray-300 shadow-sm" required onchange="updatePrice(this)">
                                <option value="">-- Select Drink --</option>
                                @foreach ($drinks as $drink)
                                    <option value="{{ $drink->id }}" data-price="{{ $drink->price }}">{{ $drink->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <input type="number" name="quantities[]" min="1" value="1" required
                                class="quantity-input w-20 rounded border-gray-300 shadow-sm text-center" onchange="updatePrice(this)" />
                        </div>
                        <div class="w-24 text-right font-semibold price-display">0.00 บาท</div>
                        <div>
                            <button type="button" class="btn-remove inline-flex items-center px-3 py-1 border border-red-600 text-red-600 rounded hover:bg-red-600 hover:text-white transition">
                                Remove
                            </button>
                        </div>
                    </div>

                </div>

                <button type="button" id="btn-add-drink" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Add Drink
                </button>
            </div>

            <div class="mt-8 flex justify-end space-x-4 items-center">
                <div class="text-lg font-semibold mr-6">
                    ราคารวม: <span id="total-price" class="text-blue-600">0.00</span> บาท
                </div>
                <a href="{{ route('orders.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400 text-gray-700">Cancel</a>
                <button type="submit" class="px-4 py-2 rounded bg-green-600 hover:bg-green-700 text-white">Save Order</button>
            </div>
        </form>
    </div>

    <script>
        const drinks = @json($drinks);

        document.addEventListener('DOMContentLoaded', function () {
            const drinkItemsContainer = document.getElementById('drink-items');
            const btnAddDrink = document.getElementById('btn-add-drink');

            btnAddDrink.addEventListener('click', function () {
                const firstItem = document.querySelector('.drink-item');
                const newItem = firstItem.cloneNode(true);

                // Reset values
                const select = newItem.querySelector('select');
                select.value = '';
                const input = newItem.querySelector('input[type="number"]');
                input.value = 1;
                newItem.querySelector('.price-display').textContent = '0.00 บาท';

                drinkItemsContainer.appendChild(newItem);
                attachRemoveEvent(newItem);
                attachChangeEvents(newItem);
                updateTotalPrice();
            });

            function attachRemoveEvent(item) {
                const btnRemove = item.querySelector('.btn-remove');
                btnRemove.addEventListener('click', function () {
                    if (drinkItemsContainer.children.length > 1) {
                        item.remove();
                        updateTotalPrice();
                    } else {
                        alert('ต้องมีเครื่องดื่มอย่างน้อย 1 รายการ');
                    }
                });
            }

            function attachChangeEvents(item) {
                const select = item.querySelector('select');
                const quantity = item.querySelector('input[type="number"]');
                select.addEventListener('change', () => updatePrice(select));
                quantity.addEventListener('change', () => updatePrice(quantity));
            }

            function updatePrice(el) {
                const item = el.closest('.drink-item');
                const select = item.querySelector('select');
                const quantityInput = item.querySelector('input[type="number"]');
                const priceDisplay = item.querySelector('.price-display');

                const selectedDrink = drinks.find(d => d.id == select.value);
                const price = selectedDrink ? selectedDrink.price : 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const totalPrice = price * quantity;

                priceDisplay.textContent = totalPrice.toFixed(2) + ' บาท';

                updateTotalPrice();
            }

            function updateTotalPrice() {
                let total = 0;
                document.querySelectorAll('.drink-item').forEach(item => {
                    const priceText = item.querySelector('.price-display').textContent;
                    const price = parseFloat(priceText) || 0;
                    total += price;
                });
                document.getElementById('total-price').textContent = total.toFixed(2);
            }

            // Attach events to initial item
            const initialItem = document.querySelector('.drink-item');
            attachRemoveEvent(initialItem);
            attachChangeEvents(initialItem);
            updatePrice(initialItem);
        });
    </script>
</x-app-layout>
