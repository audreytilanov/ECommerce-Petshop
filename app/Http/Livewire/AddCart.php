<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AddCart extends Component
{
    protected $listeners = ['cart_add' => 'render'];
    public function render()
    {
        if(!empty(Auth::guard('web')->user()->id)){
            $count = Cart::where('user_id', '=', Auth::guard('web')->user()->id)->count();
            return view('livewire.add-cart', compact('count'));
        }
        
    }
}
