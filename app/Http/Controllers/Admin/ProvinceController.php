<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvinceController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $data = Province::all();
        return view('admin.master.province.index', compact('data'));
    }

    public function create(){
        return view('admin.master.province.create');
    }

    public function store(Request $request){
        $request->validate([
            'province' => 'required|unique:provinces,province'
        ]);

        $create = Province::create([
            'province' => $request->province
        ]);

        if($create){
            toast('Provinsi berhasil ditambahkan','success');
            return redirect()->route('admin.province.index');
        }else{
            toast('Provinsi gagal ditambahkan','error');
            return redirect()->route('admin.province.index');
        }
        
    }

    public function edit($id){
        $data = Province::find($id);
        return view('admin.master.province.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'province' => 'required|unique:provinces,province'
        ]);
        $data = Province::find($id);

        $edit = $data->update([
            'province' => $request->province
        ]);

        if($edit){
            toast('Provinsi berhasil diubah','success');
            return redirect()->route('admin.province.index');
        }else{
            toast('Provinsi gagal diubah','error');
            return redirect()->route('admin.province.index');
        }
    }

    public function delete($id){
        $check = City::where('province_id', '=',$id)->get();

        if(!$check){
            $data = Province::find($id);

            $data->delete();

            toast('Provinsi berhasil dihapus','success');
            return redirect()->route('admin.province.index');
        }else{
            toast('Provinsi gagal dihapus, child ditemukan','error');
            return redirect()->route('admin.province.index');
        }
    }
}
