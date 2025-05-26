<div>
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="ค้นหาด้วยชื่อลูกค้าหรือหมายเลขออเดอร์..."
                   wire:model.debounce.300ms="search">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" wire:model="dateStart" placeholder="วันที่เริ่มต้น">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" wire:model="dateEnd" placeholder="วันที่สิ้นสุด">
        </div>
        <div class="col-md-2">
            <select class="form-select" wire:model="status">
                <option value="">สถานะทั้งหมด</option>
                <option value="pending">รอดำเนินการ</option>
                <option value="completed">สำเร็จ</option>
                <option value="cancelled">ยกเลิก</option>
            </select>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>รหัส</th>
                <th>ชื่อลูกค้า</th>
                <th>รายการ</th>
                <th>วันที่สั่ง</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr style="cursor:pointer" wire:click="showOrderDetails({{ $order->id }})">
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>
                        @foreach($order->orderItems as $item)
                            {{ $item->drink->name }} x {{ $item->quantity }}<br>
                        @endforeach
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">ไม่มีข้อมูลคำสั่งซื้อ</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $orders->links() }}
    </div>

    {{-- Modal แสดงรายละเอียดออเดอร์ --}}
    @if ($showModal && $orderDetail)
    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background-color: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg" role="document" wire:keydown.escape="closeModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดคำสั่งซื้อ #{{ $orderDetail->id }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>ชื่อลูกค้า:</strong> {{ $orderDetail->customer->name }}</p>
                    <p><strong>วันที่สั่ง:</strong> {{ $orderDetail->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>สถานะ:</strong> {{ $orderDetail->status }}</p>
                    <hr>
                    <h6>รายการสินค้า:</h6>
                    <ul>
                        @foreach ($orderDetail->orderItems as $item)
                            <li>{{ $item->drink->name }} x {{ $item->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
