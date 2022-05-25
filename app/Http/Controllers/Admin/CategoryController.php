<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $data = ProductCategory::all();
        return view('admin.master.categories.index', compact('data'));
    }

    public function create(){
        return view('admin.master.categories.create');
    }

    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name'
        ]);

        $create = ProductCategory::create([
            'category_name' => $request->category_name
        ]);

        if($create){
            toast('Kategori berhasil ditambahkan','success');
            return redirect()->route('admin.categories.index');
        }else{
            toast('Kategori gagal ditambahkan','error');
            return redirect()->route('admin.categories.index');
        }
        
    }

    public function edit($id){
        $data = ProductCategory::find($id);
        return view('admin.master.categories.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'category_name' => 'required|unique:product_categories,category_name'
        ]);
        $data = ProductCategory::find($id);

        $edit = $data->update([
            'category_name' => $request->category_name
        ]);

        if($edit){
            toast('Kategori berhasil diubah','success');
            return redirect()->route('admin.categories.index');
        }else{
            toast('Kategori gagal diubah','error');
            return redirect()->route('admin.categories.index');
        }
    }

    public function delete($id){
        $data = ProductCategory::find($id);

        $delete = $data->delete();

        if($delete){
            toast('Kategori berhasil dihapus','success');
            return redirect()->route('admin.categories.index');
        }else{
            toast('Kategori gagal dihapus','error');
            return redirect()->route('admin.categories.index');
        }
    }
}
