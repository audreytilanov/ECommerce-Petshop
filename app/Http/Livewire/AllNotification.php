<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AllNotification extends Component
{
    public function render()
    {
        $notification = Auth::guard('admin')->user()->notifications->where('read_at', null);
        $notificationRead = Auth::guard('admin')->user()->notifications->where('read_at','!=', null);
        return view('livewire.all-notification', compact('notification', 'notificationRead'));
    }

    public function markasread($id){
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
}
