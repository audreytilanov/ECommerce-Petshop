<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index($id){
        $data = ProductImage::where('product_id', '=', $id)->get();
        $product = Product::find($id);
        return view('admin.master.image.index', compact('data', 'id', 'product'));
    }

    public function create($id){
        $product = Product::find($id);
        return view('admin.master.image.create', compact('id', 'product'));
    }

    public function store(Request $request, $id){
        $request->validate([
            'image' => 'required',
        ]);

        $filename = Str::random(10).$request->image->getClientOriginalName();
        $file = $request->file('image');
        Storage::disk('asset')->put('admin/product/'.$filename, file_get_contents($file));

        $create = ProductImage::create([
            'product_id' => $id,
            'image_name' => $filename,
        ]);

        if($create){
            toast('Product Image berhasil ditambahkan','success');
            return redirect()->route('admin.image.index', $id);
        }else{
            toast('Product Image gagal ditambahkan','error');
            return redirect()->route('admin.image.index', $id);
        }
        
    }

    public function edit($id, $kode){
        $product = Product::find($id);
        $data = ProductImage::find($kode);
        return view('admin.master.image.edit', compact('data', 'id', 'product'));
    }

    public function update(Request $request, $id, $kode){
        $request->validate([
            'image' => 'required',
        ]);
        $data = ProductImage::find($kode);

        // dd($request->file('image'));

        $edit = false;

        if($request->file('image')){
            Storage::disk('asset')->delete('admin/product/'.$data->image_name);
            $filename = Str::random(10).$request->image->getClientOriginalName();
            $file = $request->file('image');
            Storage::disk('asset')->put('admin/product/'.$filename, file_get_contents($file));

            $edit = $data->update([
                'product_id' => $id,
                'image_name' => $filename,
            ]);
        }

        if($edit){
            toast('Product Image berhasil diubah','success');
            return redirect()->route('admin.image.index',$id);
        }else{
            toast('Product Image gagal diubah','error');
            return redirect()->route('admin.image.index', $id);
        }
    }

    public function delete($id, $kode){
        $data = ProductImage::find($kode);
        // dd($id);
        Storage::disk('asset')->delete('admin/product/'.$data->image_name);

        $delete = $data->delete();

        if($delete){
            toast('Product Image berhasil dihapus','success');
            return redirect()->route('admin.image.index', $id);
        }else{
            toast('Product Image gagal dihapus','error');
            return redirect()->route('admin.image.index', $id);
        }
    }
}
