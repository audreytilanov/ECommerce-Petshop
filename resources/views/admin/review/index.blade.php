@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>USER REVIEW</b></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.review.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Review</li>
                            </ol>
                        </div>
                    </div>
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
                                                <th>Product</th>
                                                <th>User</th>
                                                <th>Rating</th>
                                                <th>Comment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas->products->product_name }}</td>
                                                <td>{{ $datas->users->name }}</td>
                                                <td>{{ Str::limit($datas->rate, 50) }}</td>
                                                <td>{{ $datas->content }}</td>
                                                <td>
                                                    @if(empty($datas->responses))
                                                     <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.review.reply', ['id' => $datas->id]) }}">
                                                        Balas</a>
                                                    @else
                                                    <a class="btn btn-success btn-flat btn-addon" href="{{ route('admin.review.reply', ['id' => $datas->id]) }}">
                                                        Lihat Balasan</a>
                                                    @endif
                                                    {{--<form style="display: inline" action="{{ route('admin.cities.delete', ['kode' => $datas->id, 'id' => $id]) }}" method="post" id="delete-form{{ $datas->id }}">
                                                        @csrf
                                                        <button value="{{ $datas->id }}" id="btn-submit" class="btn btn-danger btn-flat btn-addon" type="submit"><i class="ti-trash"></i>Delete</button>
                                                    </form> --}}
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