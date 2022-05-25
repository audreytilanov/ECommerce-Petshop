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
                    <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.discount.create') }}">
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
                                                <th>Nama Produk</th>
                                                <th>Persentasi Diskon</th>
                                                <th>Mulai</th>
                                                <th>Berakhir</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas->products->product_name }}</td>
                                                <td>{{ $datas->percentage }}%</td>
                                                <td>{{ $datas->start }}</td>
                                                <td>{{ $datas->end }}</td>
                                                <td>
                                                    @if(now()>$datas->end)
                                                    <p style="border-radius: 100px" class="bg-danger text-center"><b>Berakhir</b></p>
                                                    @elseif(now()<$datas->end)
                                                    <p style="border-radius: 100px" class="bg-success text-center"><b>Berjalan</b></p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.discount.edit', ['id' => $datas->id]) }}">
                                                        <i class="ti-pencil"></i>
                                                        Edit</a>
                                                    <form style="display: inline" action="{{ route('admin.discount.delete', ['id' => $datas->id]) }}" method="post" id="delete-form{{ $datas->id }}">
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