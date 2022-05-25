<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificationAdmin extends Component
{
    public function render()
    {
        $notification = Auth::guard('admin')->user()->notifications->where('read_at', null);
        $notificationCount = Auth::guard('admin')->user()->notifications->where('read_at', null)->count();
        
        return view('livewire.notification-admin', compact('notification','notificationCount'));
    }
    public function markasread($id){
        // dd($id);
        $data = Auth::guard('admin')->user()->notifications->where('id', $id)->first();
        $data->update([
            'read_at' => now()
        ]);
    }

    public function markall(){
        // dd($id);
        $data = Auth::guard('admin')->user()->notifications->where('read_at','=', null);


        foreach ($data as $value) {
            $value->update([
                'read_at' => now()
            ]); 
        }
    }

    public function all(){
        return redirect()->route('admin.notification.all');
    }
}
