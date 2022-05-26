<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\City;
use App\Models\Admin;
use App\Models\Courier;
use App\Models\Product;
use Livewire\Component;
use App\Models\Province;
use App\Models\Transaction;
use Illuminate\Support\Carbon;
use App\Models\TransactionDetail;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminNotification;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Notification;

class TransactionOngkir extends Component
{
    public $city_destination;
    public $cities = [];
    public $dataId;
    public $province_destination;
    public $courier;
    public $cost = [];
    public $costDetail;
    public $shipping = array();
    public $package;
    public $grand_total;
    public $grand_sum;
    public $address;
    public $singleQty;

    public function render()
    {
        if(!empty($this->province_destination)) {
            $this->cities = City::where('province_id', $this->province_destination)->get();
            // dd($this->cities);
            // foreach ($this->cities as $key => $value) {
            //     dd($value);
            // }

        }
        if($this->dataId == 0 ||$this->dataId == null){
            $data = Cart::where('user_id', Auth::guard('web')->user()->id)->with(['products' => function ($q) {
                $q->with(['images']);
            }])->get();
            
        
            $total_satuan = array();
            $total_weight = array();
            foreach ($data as $total) {
                if(!empty($total->products->discounts)){
                    array_push($total_satuan, ($total->products->price - ($total->products->price * $total->products->discounts->percentage/100))* $total->qty);
                } 
                else {
                    array_push($total_satuan, $total->products->price * $total->qty);
                }
                array_push($total_weight, $total->products->weight * $total->qty);
            }
            
            $this->grand_total = array_sum($total_satuan);
            $this->grand_sum = array_sum($total_weight)*1000;
        }else{
            $data = Product::with('images')->find($this->dataId);

            $total_satuan = array();
            $total_weight = array();
            if(!empty($data->discounts)){
                array_push($total_satuan, ($data->price - ($data->price * $data->discounts->percentage/100))* $this->singleQty);

            } 
            else {
                array_push($total_satuan, $data->price * $this->singleQty);

            }
            array_push($total_weight, $data->weight * $this->singleQty);
            $this->grand_total = array_sum($total_satuan);
            $this->grand_sum = array_sum($total_weight)*1000;
        }
        // dd($data->images->first());

        // dd($this->grand_sum);
        if($this->grand_sum < 30000){
            if(!empty($this->province_destination) && !empty($this->city_destination) && !empty($this->courier)){
                $cost = RajaOngkir::ongkosKirim([
                    'origin'        => 1, // ID kota/kabupaten asal// ID BALI
                    'destination'   => $this->city_destination, // ID kota/kabupaten tujuan
                    'weight'        => $this->grand_sum, // berat barang dalam gram
                    'courier'       => $this->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
                ])->get();
                // $this->shipping = $cost[0]['costs'][0];
                $this->shipping = $cost[0]['costs'];
            }

            if(!empty($this->package)){
                foreach ($this->shipping as $key) {
                    if($key['service'] == $this->package){
                        $this->costDetail = $key['cost'][0]['value'];
                    }
                }
            }
        }else{
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Weight is over limit! (Limit 30000 Gram)',
            ]);
        }
        $provinces = Province::all();
        $couriers = Courier::all();
        // dd($provinces);
        return view('livewire.transaction-ongkir', compact('provinces', 'couriers', 'data'));
    }

    public function transaction(){
        $checkCourier = Courier::where('courier', $this->courier)->first();
        $date = Carbon::now();
        $date->setTimezone('Asia/Hong_Kong');
        $date->addDays(1);
        // dd($date);
        Transaction::create([
            'user_id' => Auth::guard('web')->user()->id,
            'courier_id' => $checkCourier->id,
            'city_id' => $this->city_destination,
            'province_id' => $this->province_destination,
            'timeout' => $date,
            'address' => $this->address,
            'total' => $this->grand_sum,
            'shipping_cost' => $this->costDetail,
            'sub_total' => $this->grand_total + $this->costDetail,
            'shipping_package' => $this->package,
            'status' => 'unpaid'
        ]);
        if($this->dataId == 0 ||$this->dataId == null){
            $data = Cart::where('user_id', Auth::guard('web')->user()->id)->with(['products' => function ($q) {
                $q->with(['images']);
            }])->get();
            $idTransactionLast = Transaction::orderBy('id', 'DESC')->first();

            foreach ($data as $value) {
                TransactionDetail::create([
                    'transaction_id' => $idTransactionLast->id,
                    'product_id' => $value->product_id,
                    'qty' => $value->qty,
                    'selling_price' => $value->products->price * $value->qty
                ]);
            }
            $getCart = Cart::where('user_id', Auth::guard('web')->user()->id);
            
            $getCart->delete();
        }else{
            $data = Product::find($this->dataId);
            $idTransactionLast = Transaction::orderBy('id', 'DESC')->first();

            TransactionDetail::create([
                'transaction_id' => $idTransactionLast->id,
                'product_id' => $data->id,
                'qty' => $this->singleQty,
                'selling_price' => $data->price * $this->singleQty
            ]);
        }
        $user = Admin::all();
        $message = "Transaksi Baru dari" . Auth::guard('web')->user()->name . "";
        Notification::send($user, new AdminNotification($message));

        toast('Thank You For Your Review','success');
        // dd($idTransactionLast);
        
        
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Transaction Placed! PAY NOW!',
        ]);
        return redirect()->route('user.history.transaction', $idTransactionLast);
        
    }

    public function addSingle(){
        $this->singleQty +=1;
    }

    public function subtractSingle(){
        if($this->singleQty <= 1){
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Quantity Invalid!',
            ]);
        }else{
            $this->singleQty -=1;

        }
    }
}
