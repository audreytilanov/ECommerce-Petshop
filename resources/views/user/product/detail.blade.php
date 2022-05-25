@extends('layouts.user')
@section('section')
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>See more Details</p>
                    <h1>Single Product</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->
<!-- single product -->
<div class="single-product mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <!-- home page slider -->
                <!-- single home slider -->
                @if($data->images->count() <= 1)
                    <div class="single-product-img">
                        @if(!empty($data->images->first()->image_name))
                            <img src="{{ URL::asset('admin/product/'.$data->images->first()->image_name) }}" alt="">
                        @endif
                    </div>
                @else
                    <div class="homepage-slider2">
                    @foreach ($data->images as $item)
                        <div class="single-homepage-slider2" style="background-image: url('{{asset('admin/product/'.$item->image_name)}}');">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-5 col-md-5 text-center">
                                        <div class="hero-text">
                                            <div class="hero-text-tablecell">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                @endif
                <!-- end home page slider -->
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3>{{ $data->product_name }}</h3>
                    <p class="single-product-pricing"><span>{{ $data->weight }} Kg</span> 
                        @if(!empty($data->discounts)) 
                        Rp. {{ number_format($data->price - ($data->price * $data->discounts->percentage/100)) }}
                        @else 
                        {{ number_format($data->price) }}
                        @endif</p>
                    <p>{{ $data->description }}</p>
                    <div class="single-product-form">
                        <a href="{{ route('user.buynow', $data->id) }}" class="buy-btn mb-3"><i class="fas fa-credit-card"></i> Buy Now</a>
                        @livewire('product-live', ['dataId'=> $data->id])
                        <p><strong>Categories: </strong>
                            @if(!empty($data->categories->categories->category_name))
                                {{ $data->categories->categories->category_name }}
                            @else
                                No Category
                            @endif
                        </p>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>
{{-- {{ dd($data->discounts) }}  --}}
<div class="comments-list-wrap col-lg-12">
    <h3 class="comment-count-title text-center">COMMENTS</h3>
@foreach ($data->reviews as $item)
    <div class="comment-list col-lg-10">
        <div class="single-comment-body">
            <div class="comment-text-body">
                <h4>{{ $item->users->name }}<span class="comment-date">{{ $item->created_at->toDateString() }}</span>
                <p>{{ $item->content }}</p>
            </div>
            @if (!empty($item->responses))
            <div class="single-comment-body child">
                <div class="comment-text-body">
                    <h4>Admin<span class="comment-date">{{ $item->responses->created_at->toDateString() }}</span>
                        <p>{{ $item->responses->content }}</p>

                </div>
            </div>
            @endif
            
        </div>
    </div>
@endforeach
</div>  

<!-- end single product -->

<!-- more products -->
<div class="more-products mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="section-title">	
                    <h3><span class="orange-text">Related</span> Products</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @forelse ($related as $more)
            <div class="col-lg-4 col-md-6 text-center">
                <div class="single-product-item">
                    <div class="product-image">
                        <a href="single-product.html">
                            @if(!empty($more->images->first()->image_name))
                                <img src="{{ URL::asset('admin/product/'.$more->images->first()->image_name) }}" alt="" height="300px">
                            @endif
                        </a>
                    </div>
                    <p class="product-price"><span>{{ $more->weight }}</span> Rp. {{ number_format($more->price) }} </p>
                    @livewire('product-live', ['dataId'=> $more->id])
                    <a href="cart.html" class="buy-btn"><i class="fas fa-credit-card"></i> Buy Now</a>
                </div>
            </div>
            @empty
                <p>No Related Product</p>
            @endforelse
        </div>
    </div>
</div>
<!-- end more products -->
@endsection