<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Notification;

class ReviewController extends Controller
{
    public function index(){
        $data = ProductReview::orderBy('created_at', 'DESC')->get();

        return view('admin.review.index', compact('data'));
    }

    public function reply($id){
        $data = ProductReview::find($id);
        return view('admin.review.reply', compact('data'));
    }

    public function post($id, Request $request){
        Response::create([
            'admin_id' => Auth::guard('admin')->user()->id,
            'review_id' => $id,
            'content' => $request->reply
        ]);
        $data = ProductReview::find($id);
        $user = User::find($data->user_id);
        $message = "Balas dari Admin";

        Notification::send($user, new UserNotification($message));
        // $this->emit('cart_add');

        toast('Balasan telah dikirim','success');
        return redirect()->route('admin.review.index');
    }
    
}
