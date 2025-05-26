@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ตรวจสอบคำสั่งซื้อ</h1>

    @livewire('order-table-one') {{-- เรียกใช้ Livewire Component ที่สร้างไว้ --}}
</div>
@endsection
    