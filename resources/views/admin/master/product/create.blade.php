@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>PRODUCTS</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>TAMBAH PRODUK</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.product.create') }}" method="post" enctype="multipart/form-data">
                                @csrf 
                                <div class="form-group">
                                    <label>Nama Product</label>
                                    <input type="text" class="form-control" placeholder="Ex. Whiskas Tuna" value="{{ old('product_name') }}" name="product_name" required>
                                    @error('product_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" placeholder="Ex. 50000" value="{{ old('price') }}" name="price" required>
                                    @error('price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <div class="col-lg-12">
                                        <textarea name="description" style="width:100%" id="description" rows="4" required>{{ old('description') }}</textarea>
                                    </div>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control" placeholder="Ex. 10" value="{{ old('stock') }}" name="stock" required>
                                    @error('stock')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Berat (in KG)</label>
                                    <input type="number" class="form-control" placeholder="Ex. 1 Kg" value="{{ old('weight') }}" name="weight" required>
                                    @error('weight')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div> 
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category_id" id="category_id" required>
                                        <option value="">-- Pilih Kategori Produk --</option>
                                        @foreach ($data as $datas)
                                            <option value="{{ $datas->id }}">{{ $datas->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>   
                                <div class="form-group">
                                    <label>Product Image <b>(MULTIPLE IMAGE SELECT)</b></label>
                                    <input type="file" class="form-control" placeholder="Ex. 1 Kg" value="{{ old('weight') }}" name="image[]" multiple required>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>  
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection