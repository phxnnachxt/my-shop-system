<?php

// app/Http/Livewire/DrinksTable.php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Drink;

class DrinksTable extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $drinks = Drink::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('livewire.drinks-table', [
            'drinks' => $drinks,
        ]);
    }
}
