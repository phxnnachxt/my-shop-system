<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class OrderTableOne extends Component
{
    use WithPagination;

    public $search = '';
    public $dateStart = null;
    public $dateEnd = null;
    public $status = '';

    public $showModal = false;
    public $orderDetail = null;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['showOrderDetails'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingDateStart()
    {
        $this->resetPage();
    }

    public function updatingDateEnd()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function showOrderDetails($orderId)
    {
        $this->orderDetail = Order::with('customer', 'orderItems.drink')->find($orderId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->orderDetail = null;
    }

    public function render()
    {
        $query = Order::with('customer', 'orderItems.drink')
            ->where(function ($q) {
                $q->whereHas('customer', function ($q2) {
                    $q2->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('id', 'like', '%' . $this->search . '%');
            });

        if ($this->dateStart) {
            $query->whereDate('created_at', '>=', $this->dateStart);
        }

        if ($this->dateEnd) {
            $query->whereDate('created_at', '<=', $this->dateEnd);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.order-table-one', [
            'orders' => $orders,
        ]);
    }
}
