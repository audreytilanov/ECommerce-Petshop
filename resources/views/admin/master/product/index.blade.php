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
                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.product.create') }}">
                        <i class="ti-plus"></i>
                        Tambah</a>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Product</th>
                                                <th>Slug</th>
                                                <th>Harga</th>
                                                <th>Kategori</th>
                                                <th>Deskripsi</th>
                                                <th>Rating</th>
                                                <th>Stok</th>
                                                <th>Berat</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Tanggal Update</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas->product_name }}</td>
                                                <td>{{ $datas->slug }}</td>
                                                <td>{{ $datas->price }}</td>
                                                <td>{{ $datas->categories->categories->category_name ?? 'NULL'}}</td>
                                                <td>{{ Str::limit($datas->description, 15) }}</td>
                                                <td>{{ $datas->product_rate }}</td>
                                                <td>{{ $datas->stock }}</td>
                                                <td>{{ $datas->weight }}</td>
                                                <td>{{ $datas->created_at }}</td>
                                                <td>{{ $datas->updated_at }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-flat btn-addon" href="{{ route('admin.image.index', ['id' => $datas->id]) }}">
                                                        <i class="ti-image"></i>
                                                        Image</a>
                                                        <br>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.product.edit', ['id' => $datas->id]) }}">
                                                        <i class="ti-pencil"></i>
                                                        Edit</a>
                                                    @if($datas->status == 1)
                                                    <form style="display: inline" action="{{ route('admin.product.delete', ['id' => $datas->id]) }}" method="post" id="delete-form{{ $datas->id }}">
                                                        @csrf
                                                        <button value="{{ $datas->id }}" id="btn-submit" class="btn btn-danger btn-flat btn-addon" type="submit"><i class="ti-trash"></i>Delete</button>
                                                    </form>
                                                    @elseif($datas->status == 0)
                                                    <form style="display: inline" action="{{ route('admin.product.activate', ['id' => $datas->id]) }}" method="post" id="activate-form{{ $datas->id }}">
                                                        @csrf
                                                        <button value="{{ $datas->id }}" id="btn-activate" class="btn btn-success btn-flat btn-addon" type="submit"><i class="ti-check"></i>Activate</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
            </section>
        </div>
    </div>
</div>
@endsection