@extends('layouts.user')
@section('section')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>User Transaction</p>
                    <h1>HISTORY TRANSACTION</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cart-banner abt-section mb-100 mt-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="abt-text">
                    @foreach ($data as $datas)
                    <div class="mb-5 mt-5">
                        <h3>{{ $datas->created_at->toDateString(); }}<span class="orange-text"> {{ $datas->created_at->format('H:i:s'); }}</span>
                            <span style="font-size: 20px">
                                @if($datas->status == 'unpaid')
                                    <span class="bg-danger text-white" style="padding:10px;"><b>UNPAID</b></span>
                                @elseif ($datas->status == 'pending')
                                    <span class="bg-secondary text-white" style="padding:10px;"><b>WAITING ADMIN TO VERIFY</b></span>
                                @elseif ($datas->status == 'admin_verified')
                                    <span class="bg-primary text-white" style="padding:10px;"><b>VERIFIED BY ADMIN</b></span>
                                @elseif ($datas->status == 'admin_deliver')
                                    <span class="bg-warning text-white" style="padding:10px;"><b>DELIVERING</b></span>
                                @elseif ($datas->status == 'success')
                                    <span class="bg-success text-white" style="padding:10px;"><b>SUCCESS</b></span>
                                @elseif ($datas->status == 'canceled')
                                    <span class="bg-danger text-white" style="padding:10px;"><b>CANCELLED</b></span>
                                @elseif ($datas->status == 'expired')
                                    <span class="bg-danger text-white" style="padding:10px;"><b>EXPIRED</b></span>
                                @elseif ($datas->status == 'admin_notverified')
                                    <span class="bg-danger text-white" style="padding:10px;"><b>PROOF OF PAYMENT INVALID</b></span>
                                @endif
                            </span>
                        </h3>
                        <h4>Courier : {{ strtoupper($datas->couriers->courier) }} | 
                            Province : {{ strtoupper($datas->provinces->province) }} | 
                            City : {{ strtoupper($datas->cities->city_name) }}
                        </h4>
                        <h5>Shipping Package : {{ strtoupper($datas->shipping_package) }} | 
                            Shipping Cost : Rp. {{ number_format($datas->shipping_cost) }} | 
                            Sub Total: Rp. {{ number_format($datas->sub_total) }}
                        </h5>
                        <a href="{{ route('user.history.transaction', $datas->id) }}" class="boxed-btn mt-4">Detail</a>
                    </div>
                    <hr style="border:1px solid black;">
                    @endforeach
                    
                </div>

            </div>

        </div>
    </div>
</div>
<!-- end advertisement section -->
@endsection