<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $data = Discount::all();
        return view('admin.master.discount.index', compact('data'));
    }

    public function create(){
        $product = Product::all();
        return view('admin.master.discount.create', compact('product'));
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required',
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $create = Discount::create([
            'product_id' => $request->product_id,
            'percentage' => $request->percentage,
            'start' => $request->start,
            'end' => $request->end
        ]);

        if($create){
            toast('Diskon berhasil ditambahkan','success');
            return redirect()->route('admin.discount.index');
        }else{
            toast('Diskon gagal ditambahkan','error');
            return redirect()->route('admin.discount.index');
        }
        
    }

    public function edit($id){
        $data = Discount::find($id);
        $product = Product::all();

        return view('admin.master.discount.edit', compact('data', 'product'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'product_id' => 'required',
            'percentage' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        $data = Discount::find($id);

        $edit = $data->update([
            'product_id' => $request->product_id,
            'percentage' => $request->percentage,
            'start' => $request->start,
            'end' => $request->end
        ]);

        if($edit){
            toast('Diskon berhasil diubah','success');
            return redirect()->route('admin.discount.index');
        }else{
            toast('Diskon gagal diubah','error');
            return redirect()->route('admin.discount.index');
        }
    }

    public function delete($id){
        $data = Discount::find($id);

        $delete = $data->delete();

        if($delete){
            toast('Diskon berhasil dihapus','success');
            return redirect()->route('admin.discount.index');
        }else{
            toast('Diskon gagal dihapus','error');
            return redirect()->route('admin.discount.index');
        }
    }
}
