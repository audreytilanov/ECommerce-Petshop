<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Province;

class CitiesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index($id){
        $data = City::where('province_id', '=', $id)->get();
        $province = Province::find($id);
        return view('admin.master.cities.index', compact('data', 'id', 'province'));
    }

    public function create($id){
        $province = Province::find($id);
        return view('admin.master.cities.create', compact('id', 'province'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'cities' => 'required|unique:cities,city_name',
            'postal_code' => 'required|integer'
        ]);

        $create = City::create([
            'province_id' => $id,
            'city_name' => $request->cities,
            'postal_code' => $request->postal_code
        ]);

        if($create){
            toast('Kota berhasil ditambahkan','success');
            return redirect()->route('admin.cities.index', $id);
        }else{
            toast('Kota gagal ditambahkan','error');
            return redirect()->route('admin.cities.index', $id);
        }
        
    }

    public function edit($id, $kode){
        $province = Province::find($id);
        $data = City::find($kode);
        return view('admin.master.cities.edit', compact('data', 'id', 'province'));
    }

    public function update(Request $request, $id, $kode){
        $request->validate([
            'cities' => 'required|unique:cities,city_name',
            'postal_code' => 'required|integer'
        ]);
        $data = City::find($kode);

        $edit = $data->update([
            'province_id' => $id,
            'city_name' => $request->cities,
            'postal_code' => $request->postal_code
        ]);

        if($edit){
            toast('Kota berhasil diubah','success');
            return redirect()->route('admin.cities.index',$id);
        }else{
            toast('Kota gagal diubah','error');
            return redirect()->route('admin.cities.index', $id);
        }
    }

    public function delete($id, $kode){
        $data = City::find($kode);
        // dd($id);

        $delete = $data->delete();

        if($delete){
            toast('Kota berhasil dihapus','success');
            return redirect()->route('admin.cities.index', $id);
        }else{
            toast('Kota gagal dihapus','error');
            return redirect()->route('admin.cities.index', $id);
        }
    }
}
