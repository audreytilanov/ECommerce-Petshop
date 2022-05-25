@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>IMAGES of {{ strtoupper($product->product_name) }}</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
                                <li class="breadcrumb-item active">Image</li>
                            </ol>
                        </div>
                    </div>
                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.image.create', ['id' => $id]) }}">
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
                                                <th>Image</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Tanggal Update</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ URL::asset('admin/product/'.$datas->image_name ) }}" alt="" width="150px">
                                                </td>
                                                <td>{{ $datas->created_at }}</td>
                                                <td>{{ $datas->updated_at }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.image.edit', ['kode' => $datas->id, 'id' => $id]) }}">
                                                        <i class="ti-pencil"></i>
                                                        Edit</a>
                                                    <form style="display: inline" action="{{ route('admin.image.delete', ['kode' => $datas->id, 'id' => $id]) }}" method="post" id="delete-form{{ $datas->id }}">
                                                        @csrf
                                                        <button value="{{ $datas->id }}" id="btn-submit" class="btn btn-danger btn-flat btn-addon" type="submit"><i class="ti-trash"></i>Delete</button>
                                                    </form>
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