@extends('layouts.admin')
@section('section')
<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><b>REPLY a REVIEW</b></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.review.index') }}">Review</a></li>
                                <li class="breadcrumb-item active">Reply</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4><b>Reply Customer Review</b></h4>
                        
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('admin.review.post', ['id' => $data->id]) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Review</label>
                                    <textarea class="form-control" name="content" id="content" cols="30" rows="10" disabled>{{ $data->content }}</textarea>
                                    @error('content')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Rate <span><i class="fa fa-star" aria-hidden="true"></i></span></label>
                                    <input type="number" class="form-control" placeholder="Ex. 80223" value="{{ $data->rate }}" name="rate" disabled>
                                    @error('rate')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>Produk</label>
                                    <input type="text" class="form-control" placeholder="Ex. 80223" value="{{ $data->products->product_name }}" name="product" disabled>
                                    @error('product')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" class="form-control" placeholder="Ex. 80223" value="{{ $data->users->name }}" name="user" disabled>
                                    @error('user')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                @if(empty($data->responses))
                                <div class="form-group">
                                    <label>Admin's Reply</label>
                                    <textarea class="form-control" name="reply" id="reply" cols="30" rows="10" required></textarea>
                                    @error('reply')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                @else
                                <div class="form-group">
                                    <label>Admin's Reply</label>
                                    <textarea class="form-control" name="reply" id="reply" cols="30" rows="10" disabled>{{ $data->responses->content }}</textarea>
                                    @error('reply')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                @endif
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection