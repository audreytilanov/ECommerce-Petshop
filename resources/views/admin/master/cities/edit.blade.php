@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>CITIES of {{ strtoupper($province->province) }}</b>, <span>Master Data</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.province.index') }}">Province</a></li>
                                <li class="breadcrumb-item active">Cities</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>EDIT KOTA {{ strtoupper($province->province) }}</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.cities.update', ['id' => $id, 'kode' => $data->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Nama Kota</label>
                                    <input type="text" class="form-control" placeholder="Ex. Denpasar" value="{{ $data->city_name }}" name="cities" required>
                                    @error('cities')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Pos</label>
                                    <input type="number" class="form-control" placeholder="Ex. 80223" value="{{ $data->postal_code }}" name="postal_code" required>
                                    @error('postal_code')
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