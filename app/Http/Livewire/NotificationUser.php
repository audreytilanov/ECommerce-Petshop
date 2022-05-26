<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotification;


class NotificationUser extends Component
{
    protected $listeners = ['user_notif' => 'render'];

    public function render()
    {
        $notification = Auth::guard('web')->user()->notifications->where('read_at', null);
        $notificationRead = Auth::guard('web')->user()->notifications->where('read_at','!=', null);
        return view('livewire.notification-user', compact('notification','notificationRead'));
    }

    public function markasread($id){
        $data = Auth::guard('web')->user()->notifications->where('id', $id)->first();

        $data->update([
            'read_at' => now()
        ]);
    }

    public function markall(){
        // dd($id);
        $data = Auth::guard('web')->user()->notifications->where('read_at','=', null);


        foreach ($data as $value) {
            $value->update([
                'read_at' => now()
            ]); 
        }
    }
}
