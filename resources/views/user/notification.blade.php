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
                    
                    @livewire('notification-user')
                    
                </div>

            </div>

        </div>
    </div>
</div>
<!-- end advertisement section -->
@endsection