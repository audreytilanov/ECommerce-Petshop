<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductCategoryDetail;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    
    public function index(){
        $data = Product::with(['categories' => function ($q) {
            $q->with(['categories']);
        }])->get();
        // dd($data[6]->categories->categories->category_name);
        return view('admin.master.product.index', compact('data'));
    }

    public function create(){
        $data = ProductCategory::all();
        return view('admin.master.product.create', compact('data'));
    }

    public function store(Request $request){
        $slugs = $request->product_name;
        $slugs .= " ".$request->weight;
        $slug = strtolower(str_replace(' ', '-', $slugs)); 
        
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'price' => 'required',
            'description' => 'required|min:20',
            'stock' => 'required',
            'weight' => 'required',
        ]);

        $create = Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'slug' => $slug,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ]);

        $product_id = Product::orderBy('created_at', 'desc')->first();

        ProductCategoryDetail::create([
            'product_id' => $product_id->id,
            'category_id' => $request->category_id,
        ]);

        // dd($request->image);
        if($request->file('image')){
            foreach ($request->file('image') as $image) {
                $filename = Str::random(10).$image->getClientOriginalName();
                Storage::disk('asset')->put('admin/product/'.$filename, file_get_contents($image));         
                ProductImage::create([
                    'product_id' => $product_id->id,
                    'image_name' => $filename,
                ]);
            }
        }
        if($create){
            toast('Produk berhasil ditambahkan','success');
            return redirect()->route('admin.product.index');
        }else{
            toast('Produk gagal ditambahkan','error');
            return redirect()->route('admin.product.index');
        }
        
    }

    public function edit($id){
        $cat = ProductCategory::all();
        $data = Product::find($id);
        return view('admin.master.product.edit', compact('cat', 'data'));
    }

    public function update(Request $request, $id){
        $slugs = $request->product_name;
        $slugs .= " ".$request->weight;
        $slug = strtolower(str_replace(' ', '-', $slugs)); 
        
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
            'price' => 'required',
            'description' => 'required|min:20',
            'stock' => 'required',
            'weight' => 'required',
        ]);
        $data = Product::find($id);

        $edit = $data->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'slug' => $slug,
            'description' => $request->description,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ]);

        $detail = ProductCategoryDetail::where('product_id','=',$data->id)->first();
        $detail->update([
            'category_id' => $request->category_id,
        ]);

        if($edit){
            toast('Produk berhasil diubah','success');
            return redirect()->route('admin.product.index');
        }else{
            toast('Produk gagal diubah','error');
            return redirect()->route('admin.product.index');
        }
    }

    public function delete($id){
        $data = Product::find($id);

        $delete = $data->update([
            'status' => 0
        ]);

        if($delete){
            toast('Produk berhasil dinonaktifkan','success');
            return redirect()->route('admin.product.index');
        }else{
            toast('Produk gagal dinonaktifkan','error');
            return redirect()->route('admin.product.index');
        }
    }

    public function activate($id){
        $data = Product::find($id);

        $delete = $data->update([
            'status' => 1
        ]);

        if($delete){
            toast('Produk berhasil diaktifkan','success');
            return redirect()->route('admin.product.index');
        }else{
            toast('Produk gagal diaktifkan','error');
            return redirect()->route('admin.product.index');
        }
    }
}
