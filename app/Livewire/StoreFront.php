<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StoreFront extends Component
{
    use WithPagination;

    #[Url]
    public $search = '';

    #[Computed]
    public function products()
    {
        return Product::query()
            ->when($this->search, function (Builder $builder){
                $builder->where('name', 'like',"%{$this->search}%");
            })->paginate(5);
    }

    public function render()
    {
        return view('livewire.store-front');
    }
}
