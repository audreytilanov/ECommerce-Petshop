@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>DISCOUNT</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Discount</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>TAMBAH DISCOUNT</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.discount.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Product</label>
                                    <select class="form-control" name="product_id" id="product_id" required>
                                        <option value="">Pilih Produk</option>
                                        @foreach ( $product as $product_id)
                                            <option value="{{ $product_id->id }}">{{ $product_id->product_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('product_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Persentasi Diskon</label>
                                    <input type="text" class="form-control" placeholder="Ex. 50%" value="{{ old('percentage') }}" name="percentage" required>
                                    @error('percentage')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Mulai</label>
                                    <input type="date" class="form-control" placeholder="Ex. 50%" value="{{ old('start') }}" name="start" required>
                                    @error('start')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Berakhir</label>
                                    <input type="date" class="form-control" placeholder="Ex. 50%" value="{{ old('end') }}" name="end" required>
                                    @error('end')
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