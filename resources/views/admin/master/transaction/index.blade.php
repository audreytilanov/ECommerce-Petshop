@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>USER TRANSACTION</b></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                    {{-- <a class="btn btn-primary btn-flat btn-addon float-right" href="{{ route('admin.province.create') }}">
                        <i class="ti-plus"></i>
                        Tambah</a> --}}
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
                                                <th>User</th>
                                                <th>Kurir</th>
                                                <th>Kota</th>
                                                <th>Provinsi</th>
                                                <th>Alamat</th>
                                                <th>Total Berat</th>
                                                <th>Sub Total</th>
                                                <th>Bukti Pembayaran</th>
                                                <th>Paket Pengantaran</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $data as $datas )
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $datas->users->name }}</td>
                                                <td>{{ $datas->couriers->courier }}</td>
                                                <td>{{ $datas->cities->city_name }}</td>
                                                <td>{{ $datas->provinces->province }}</td>
                                                <td>{{ Str::limit($datas->address, 10) }}</td>
                                                
                                                <td>{{ $datas->total }}</td>
                                                <td>{{ $datas->sub_total }}</td>
                                                <td>
                                                    @if(!empty($datas->proof_of_payment))
                                                        <img height="200px" src="{{ URL::asset('user/payment/'.$datas->proof_of_payment) }}" alt="proof_of_payment">
                                                    @else
                                                        Belum di Upload
                                                    @endif
                                                </td>
                                                <td>{{ $datas->shipping_package }}</td>
                                                <td>{{ $datas->status }}</td>
                                                <td>
                                                    {{-- <a class="btn btn-info btn-flat btn-addon" href="{{ route('admin.cities.index', ['id' => $datas->id]) }}">
                                                        <i class="ti-location-arrow"></i>
                                                        Kota</a>
                                                    <a class="btn btn-warning btn-flat btn-addon" href="{{ route('admin.province.edit', ['id' => $datas->id]) }}">
                                                        <i class="ti-pencil"></i>
                                                        Edit</a> --}}
                                                    @if($datas->status == 'pending')
                                                        <form style="display: inline" action="{{ route('admin.transaction.verify', ['id' => $datas->id]) }}" method="post" id="delete-form{{ $datas->id }}">
                                                            @csrf
                                                            <button value="{{ $datas->id }}" id="btn-submit" class="btn btn-warning btn-flat" type="submit">Verify</button>
                                                        </form>
                                                        <form style="display: inline" action="{{ route('admin.transaction.notverified', ['id' => $datas->id]) }}" method="post" id="delete-form-notverify{{ $datas->id }}">
                                                            @csrf
                                                            <button value="{{ $datas->id }}" id="btn-submit-notverify" class="btn btn-danger btn-flat" type="submit">Not Verified</button>
                                                        </form>
                                                    @elseif($datas->status == 'admin_verified')
                                                        <form style="display: inline" action="{{ route('admin.transaction.deliver', ['id' => $datas->id]) }}" method="post" id="delete-form-verify{{ $datas->id }}">
                                                            @csrf
                                                            <button value="{{ $datas->id }}" id="btn-submit-verify" class="btn btn-info btn-flat" type="submit">Deliver</button>
                                                        </form>
                                                    {{-- @elseif($datas->status == 'admin_deliver') --}}
                                                    @elseif($datas->status == 'admin_deliver')
                                                            <button disabled value="{{ $datas->id }}" id="btn-submit-verify" class="btn btn-info btn-flat" type="submit">Waiting User Confirmation</button>
                                                    @elseif($datas->status == 'success')
                                                        <button disabled value="{{ $datas->id }}" id="btn-submit-verify" class="btn btn-info btn-flat" type="submit">Success</button>
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