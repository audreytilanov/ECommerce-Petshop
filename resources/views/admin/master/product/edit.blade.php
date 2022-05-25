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
                        <h4><b>EDIT PRODUK</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.product.update',['id' => $data->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Product</label>
                                    <input type="text" class="form-control" placeholder="Ex. Whiskas Tuna" value="{{ $data->product_name }}" name="product_name" required>
                                    @error('product_name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" placeholder="Ex. 50000" value="{{ $data->price }}" name="price" required>
                                    @error('price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <div class="col-lg-12">
                                        <textarea name="description" style="width:100%" id="description" rows="4" required>{{ $data->description }}</textarea>
                                    </div>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control" placeholder="Ex. 10" value="{{ $data->stock }}" name="stock" required>
                                    @error('stock')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>  
                                <div class="form-group">
                                    <label>Berat (in Kg)</label>
                                    <input type="number" class="form-control" placeholder="Ex. 1 " value="{{ $data->weight }}" name="weight" required>
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
                                        @foreach ($cat as $cate)
                                            <option value="{{ $cate->id }}" @if($cate->id == $data->categories->category_id) selected @endif>{{ $cate->category_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
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