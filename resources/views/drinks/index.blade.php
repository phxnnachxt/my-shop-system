<!-- resources/views/drinks/index.blade.php -->
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
        font-size: 0.75rem;
        /* text-xs */
        font-weight: 600;
        /* font-semibold */
        text-transform: uppercase;
        border-radius: 0.375rem;
        /* rounded-md */
        color: white;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        user-select: none;
        letter-spacing: 0.05em;
        /* tracking-wider */
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายการเครื่องดื่ม
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="alert-error">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('drinks.create') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                + เพิ่มเครื่องดื่ม
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($drinks as $drink)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $drink->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $drink->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ number_format($drink->price, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2">
                                        <form>
                                            <a href="{{ route('drinks.edit', $drink->id) }}"
                                                class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-gray-700 active:bg-gray-900">
                                                {{ __('Edit') }}
                                            </a>
                                        </form>


                                        <form action="{{ route('drinks.destroy', $drink->id) }}" method="POST"
                                            onsubmit="return confirm('คุณแน่ใจจะลบเครื่องดื่มนี้หรือไม่?');"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn-actions inline-flex items-center flex-grow px-4 py-2 ml-4 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-wider hover:bg-red-700 active:bg-red-900">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $drinks->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
