<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartLive extends Component
{
    public function render()
    {
        $data = Cart::where('user_id', Auth::guard('web')->user()->id)->with(['products' => function ($q) {
            $q->with(['images','discounts']);
        }],)->get();
        // dd($data);
        $total_satuan = array();
        $total_weight = array();
        foreach ($data as $total) {
            // dd($total->products->discounts);
            if(!empty($total->products->discounts)){
                array_push($total_satuan, ($total->products->price - ($total->products->price * $total->products->discounts->percentage/100))* $total->qty);
            } 
            else {
                array_push($total_satuan, $total->products->price * $total->qty);
            }
            array_push($total_weight, $total->products->weight * $total->qty);
        }
        // dd($total_satuan);
        $grand_total = array_sum($total_satuan);
        $grand_sum = array_sum($total_weight);
        
        return view('livewire.cart-live', compact('data', 'grand_total', 'grand_sum'));
    }

    public function add($id){
        $data = Cart::find($id);
        $data->update([
            'qty' => $data->qty + 1
        ]);
    }

    public function subtract($id){
        $data = Cart::find($id);
        $data->update([
            'qty' => $data->qty - 1
        ]);
    }

    public function delete($id){
        $data = Cart::find($id);
        $data->delete();
        
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Item Deleted',
        ]);
    }
}
