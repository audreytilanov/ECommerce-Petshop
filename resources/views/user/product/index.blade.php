@extends('layouts.user')
@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fresh and Organic</p>
                    <h1>Shop</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($category as $cat)
                        <li data-filter=".{{ $cat->id }}">{{ $cat->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row product-lists">
            {{-- {{ dd() }} --}}

            @foreach ($data as $datas)
            <div class="col-lg-4 col-md-6 text-center {{ $datas->categories->category_id ?? '' }}">
                <div class="single-product-item">
                    <div class="product-image">
                        {{-- {{ dd($datas) }} --}}
                        {{-- <p>{{ dd(!empty($datas->images->first()->image_name))}}</p> --}}
                        <a href="{{ route('user.shop.detail', $datas->id) }}">
                        @if(!empty($datas->images->first()->image_name))
                            <img src="{{ URL::asset('admin/product/'.$datas->images->first()->image_name) }}" height="300px" alt=""></a>
                        @endif
                    </div>
                    <h3>{{ $datas->product_name }}</h3>
                    <p class="product-price"><span>{{ $datas->weight }} Kg</span>
                        @if(!empty($datas->discounts)) 
                        Rp. {{ number_format($datas->price - ($datas->price * $datas->discounts->percentage/100)) }}
                        @else 
                        {{ number_format($datas->price) }}
                        @endif
                        </p>
                    @livewire('product-live', ['dataId'=> $datas->id])
                    <a href="{{ route('user.buynow', $datas->id) }}" class="buy-btn"><i class="fas fa-credit-card"></i> Buy Now</a>
                </div>
            </div>
            @endforeach

        </div>
        {{ $data->links() }}
    </div>
</div>


<!-- end products -->

<!-- logo carousel -->
<div class="logo-carousel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-carousel-inner">
                    <div class="single-logo-item">
                        <img src="assets/img/company-logos/1.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="assets/img/company-logos/2.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="assets/img/company-logos/3.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="assets/img/company-logos/4.png" alt="">
                    </div>
                    <div class="single-logo-item">
                        <img src="assets/img/company-logos/5.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end logo carousel -->
@endsection