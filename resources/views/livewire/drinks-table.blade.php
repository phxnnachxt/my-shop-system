<div class="p-4">
    <div class="mb-4 flex justify-between items-center">
        <h2 class="text-xl font-bold">Laravel-Datatable</h2>
        <input type="text" wire:model.debounce.300ms="search" class="border rounded p-2" placeholder="Search...">
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr class="bg-gray-200 text-gray-700 text-left">
                <th class="py-2 px-4">ID</th>
                <th class="py-2 px-4">NAME</th>
                <th class="py-2 px-4">TYPE</th>
                <th class="py-2 px-4">PRICE</th>
                <th class="py-2 px-4">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drinks as $drink)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $drink->id }}</td>
                    <td class="py-2 px-4">{{ $drink->name }}</td>
                    <td class="py-2 px-4">{{ $drink->type }}</td>
                    <td class="py-2 px-4">{{ $drink->price }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <button class="bg-gray-800 text-white px-3 py-1 rounded">VIEW</button>
                        <button class="bg-indigo-500 text-white px-3 py-1 rounded">EDIT</button>
                        <button class="bg-red-500 text-white px-3 py-1 rounded">DELETE</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $drinks->links() }}
    </div>
</div>
