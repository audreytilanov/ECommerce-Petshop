<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

class ProductLive extends Component
{
    public $dataId;
    public function render()
    {
        return view('livewire.product-live');
    }

    public function addToCart($product_id){
        // dd($product_id);
        $cart = Cart::where('product_id', $product_id)->where('user_id', Auth::guard('web')->user()->id)->first();
        if(!empty($cart)){
            $qty = $cart->qty + 1;
            $cart->update([
                'qty' => $qty
            ]);
        }else{
            Cart::create([
                'user_id' => Auth::guard('web')->user()->id,
                'product_id' => $product_id,
                'qty' => 1
            ]);
        }
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Product Added to Cart',
        ]);

        $this->emit('cart_add');
    }
}
