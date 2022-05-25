<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\ProductCategory;
use App\Models\TransactionDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AdminNotification;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;

class ShopController extends Controller
{
    public function index(){
        $data = Product::with(['categories' => function ($q) {
            $q->with(['categories']);
        }, 'images'])->paginate(10);
        // dd($data[6]->categories);
        $category = ProductCategory::all();
        return view('user.product.index', compact('data', 'category'));
    }

    public function detail($id){
        $related = Product::with(['categories' => function ($q) {
            $q->with(['categories']);
        }, 'images'])->take(3)->orderBy('created_at', 'DESC')->get();
        $data = Product::where('id', $id)->with(['categories' => function ($q) {
            $q->with(['categories']);
        }, 'images', 'reviews','discounts'])->first();
        // dd($related);
        return view('user.product.detail', compact('data', 'related'));
    }

    public function cart(){
        return view('user.transaction.cart');
    }

    public function transaction(){
        $count = Cart::where('user_id', '=', Auth::guard('web')->user()->id)->count();
        if($count <= 0){
            Alert::success('Page Invalid','No Item Detected');

        }else{
            $id = 0;
            
            return view('user.transaction.transaction', compact('id'));
        }
    }

    public function buynow($id){
        return view('user.transaction.transaction', compact('id'));
        
    }

    public function historyTransactionIndex(){
        $data = Transaction::where('user_id', '=', Auth::guard('web')->user()->id)->get();
        
        return view('user.transaction.history', compact('data'));
    }

    public function transactionSave(){
        return view('user.transaction.history');
    }

    public function historyTransaction($id){
        $transaction = Transaction::find($id);
        $data= TransactionDetail::where('transaction_id', $id)->with(['products' => function ($q) {
            $q->with(["reviews" => function($q){
                $q->where('product_reviews.user_id', '=', 3);
            }]);
        }])->get();
        // dd($data);
        // dd($data[0]->products->reviews[0]->product_id == $data[0]->product_id);

        return view('user.transaction.historydetail', compact('transaction', 'data'));

    }

    public function expired($id){
        $data = Transaction::find($id);
        $data->update([
            'status' => 'expired'
        ]);
    }
    
    public function payment($id, Request $request){
        $filename = Str::random(10).$request->image->getClientOriginalName();
        $file = $request->file('image');
        Storage::disk('asset')->put('user/payment/'.$filename, file_get_contents($file));

        $create = Transaction::find($id);

        $create->update([
            'proof_of_payment' => $filename,
            'status' => 'pending'
        ]);

        $user = Admin::all();
        $message = "Bukti Pembayaran terbaru dari" . Auth::guard('web')->user()->id . "";

        toast('Thank You For Your Review','success');
        Notification::send($user, new AdminNotification($message));

        if($create){
            toast('Proof of Payment has been added','success');
            return redirect()->route('user.history.transaction', $id);
        }else{
            toast('Proof of Payment failed to add','error');
            return redirect()->route('user.history.transaction', $id);
        }
    }

    public function paymentEdit($id, Request $request){
        $create = Transaction::find($id);
        Storage::disk('asset')->delete('user/payment/'.$create->proof_of_payment);
        $filename = Str::random(10).$request->image->getClientOriginalName();
        $file = $request->file('image');
        Storage::disk('asset')->put('user/payment/'.$filename, file_get_contents($file));

        $create->update([
            'proof_of_payment' => $filename,
            'status' => 'pending'
        ]);
        $user = Admin::all();
        $message = "Perubahan bukti pembayaran terbaru dari" . Auth::guard('web')->user()->id . "";

        toast('Thank You For Your Review','success');
        Notification::send($user, new AdminNotification($message));
        if($create){
            toast('Proof of Payment successfully edited','success');
            return redirect()->route('user.history.transaction', $id);
        }else{
            toast('Proof of Payment failed to edit','error');
            return redirect()->route('user.history.transaction', $id);
        }
    }

    public function cancel($id){
        $status = Transaction::find($id);
        $status->update([
            'status' => 'canceled'
        ]);
        return redirect()->route('user.history.transaction', $id);

    }

    public function success($id){
        $data = Transaction::find($id);

        $data->update([
            'status' => 'success'
        ]); 
        $user = Admin::all();
        $message = "Transaksi " . Auth::guard('web')->user()->id . " dengan ID ".$data->id.", telah berhasil";

        Notification::send($user, new AdminNotification($message));
        return redirect()->route('user.history.transaction', $id);
    }

    public function review($id, Request $request, $transaction_id){
        // dd($request);
        ProductReview::create([
            'product_id' => $id,
            'rate' => $request->rate,
            'content' => $request->content,
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $user = Admin::all();
        $message = "Review terbaru dari" . Auth::guard('web')->user()->id . "";

        toast('Thank You For Your Review','success');
        Notification::send($user, new AdminNotification($message));
        return redirect()->route('user.history.transaction', $transaction_id);
    }

    public function notification(){
        return view('user.notification');
    }
}
