<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $data = Courier::all();
        return view('admin.master.courier.index', compact('data'));
    }

    public function create(){
        return view('admin.master.courier.create');
    }

    public function store(Request $request){
        $request->validate([
            'courier' => 'required|unique:couriers,courier'
        ]);

        $create = Courier::create([
            'courier' => $request->courier
        ]);

        if($create){
            toast('Kurir berhasil ditambahkan','success');
            return redirect()->route('admin.couriers.index');
        }else{
            toast('Kurir gagal ditambahkan','error');
            return redirect()->route('admin.couriers.index');
        }
        
    }

    public function edit($id){
        $data = Courier::find($id);
        return view('admin.master.courier.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'courier' => 'required|unique:couriers,courier'
        ]);
        $data = Courier::find($id);

        $edit = $data->update([
            'courier' => $request->courier
        ]);

        if($edit){
            toast('Kurir berhasil diubah','success');
            return redirect()->route('admin.couriers.index');
        }else{
            toast('Kurir gagal diubah','error');
            return redirect()->route('admin.couriers.index');
        }
    }

    public function delete($id){
        $data = Courier::find($id);

        $delete = $data->delete();

        if($delete){
            toast('Kurir berhasil dihapus','success');
            return redirect()->route('admin.couriers.index');
        }else{
            toast('Kurir gagal dihapus','error');
            return redirect()->route('admin.couriers.index');
        }
    }
}
