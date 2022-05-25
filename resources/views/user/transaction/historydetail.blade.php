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
<!-- cart -->

<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="total-section">
                    <table class="total-table">
                        <thead class="total-table-head">
                            <tr class="table-total-row">
                                <th>Summary</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="total-data">
                                <td><strong>Status: </strong></td>
                                <td>
                                    @if($transaction->status == 'unpaid')
                                        <span class="bg-danger text-white" style="border-radius: 10%;padding:10px;"><b>UNPAID</b></span>
                                    @elseif ($transaction->status == 'pending')
                                        <span class="bg-secondary text-white" style="border-radius: 10%;padding:10px;"><b>WAITING ADMIN TO VERIFY</b></span>
                                    @elseif ($transaction->status == 'admin_verified')
                                        <span class="bg-primary text-white" style="border-radius: 10%;padding:10px;"><b>VERIFIED BY ADMIN</b></span>
                                    @elseif ($transaction->status == 'admin_deliver')
                                        <span class="bg-warning text-white" style="border-radius: 10%;padding:10px;"><b>DELIVERING</b></span>
                                    @elseif ($transaction->status == 'success')
                                        <span class="bg-success text-white" style="border-radius: 10%;padding:10px;"><b>SUCCESS</b></span>
                                    @elseif ($transaction->status == 'canceled')
                                        <span class="bg-danger text-white" style="border-radius: 10%;padding:10px;"><b>CANCELLED</b></span>
                                    @elseif ($transaction->status == 'expired')
                                        <span class="bg-danger text-white" style="border-radius: 10%;padding:10px;"><b>EXPIRED</b></span>
                                    @elseif ($transaction->status == 'admin_notverified')
                                        <span class="bg-danger text-white" style="border-radius: 10%;padding:10px;"><b>PROOF OF PAYMENT INVALID</b></span>
                                    @endif
                                </td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Time Left: </strong></td>
                                
                                <td><p id="demo"></p></td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Address: </strong></td>
                                <td>{{ $transaction->address }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Province: </strong></td>
                                <td>{{ $transaction->provinces->province }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>City: </strong></td>
                                <td>{{ $transaction->cities->city_name }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Courier: </strong></td>
                                <td>{{ $transaction->couriers->courier }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Courier: </strong></td>
                                <td>{{ $transaction->shipping_package }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Total Weight: </strong></td>
                                <td>{{ $transaction->total }} Kg</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Shipping Cost: </strong></td>
                                <td>{{ $transaction->shipping_cost }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Grand Total: </strong></td>
                                <td>Rp. {{ number_format($transaction->sub_total) }}</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Proof of Payment: (Image)</strong></td>
                                @if ($transaction->status == 'admin_deliver')
                                <td>
                                
                                    <form action="{{ route('user.transaction.success', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <button class="cart-btn" type="submit">Success Confirmation</button>
                                    </form>
                                    @if(!empty($transaction->proof_of_payment) && $transaction->status != 'admin_notverified')
                                        <img width="200px" src="{{ URL::asset('user/payment/'.$transaction->proof_of_payment) }}" alt="proof_of_payment">
                                    @endif
                                @elseif(!empty($transaction->proof_of_payment) && $transaction->status != 'admin_notverified')
                                <td>
                                    <img width="200px" src="{{ URL::asset('user/payment/'.$transaction->proof_of_payment) }}" alt="proof_of_payment">
                                </td>
                                @elseif ($transaction->status == 'canceled' || $transaction->status == 'expired')
                                <td>
                                    This Transaction isn't Active!
                                </td>
                                @else
                                <td>
                                    @if (!$transaction->status == 'admin_notverified')
                                    <form action="{{ route('user.transaction.payment', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="image" id="image" required>
                                        <button class="cart-btn" type="submit">Submit</button>
                                    </form>
                                    @else
                                    <form action="{{ route('user.transaction.payment.edit', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="image" id="image" required>
                                        <button class="cart-btn" type="submit">Submit</button>
                                    </form>
                                    @endif
                                    @if ($transaction->status == 'unpaid')
                                    <form action="{{ route('user.transaction.cancel', $transaction->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <button style="" class="buy-btn bg-danger text-white" type="submit">Cancel Transaction</button>
                                    </form>
                                    @else
                                    This Transaction isn't Active!

                                    @endif
                                </td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    {{-- <div class="cart-buttons">
                        <a href="{{ route('user.transaction') }}" class="boxed-btn black">Check Out</a>
                    </div> --}}
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="cart-table-wrap">
                    <table class="cart-table">
                        <thead class="cart-table-head">
                            <tr class="table-head-row">
                                <th class="product-image">Product Image</th>
                                <th class="product-image">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-quantity">discount</th>
                                <th class="product-total">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $datas)
                            <tr class="table-body-row">
                                <td class="product-image">
                                    @if(!empty($datas->products->images->first()->image_name))
                                        <img src="{{ URL::asset('admin/product/'.$datas->products->images->first()->image_name) }}" alt=""></a>
                                    @endif
                                </td>
                                <td class="product-name">{{ $datas->products->product_name }}</td>
                                <td class="product-price">Rp. {{ number_format($datas->products->price) }}</td>
                                <td class="product-quantity">
                                    <input type="number" class="text-center" style="max-width: 50px" value="{{ $datas->qty }}" disabled>
                                </td>
                                <td class="product-total"></td>
                                <td class="product-total">Rp. {{ number_format($datas->selling_price) }}</td>
                            </tr>
                            {{-- {{ dd($data[2]->products->reviews->first()) }} --}}
                            @if($transaction->status == 'success' && empty($datas->products->reviews->first()))
                            <tr>
                                <form action="{{ route('user.transaction.review', ['id'=>$datas->product_id, 'transaction_id' =>$transaction->id]) }}" method="POST">
                                    @csrf
                                    <td>
                                        <b>REVIEW</b>
                                    </td>
                                    <td colspan="2">
                                        <span class="star-rating">
                                            <input type="radio" name="rate" value="1"><i></i>
                                            <input type="radio" name="rate" value="2"><i></i>
                                            <input type="radio" name="rate" value="3"><i></i>
                                            <input type="radio" name="rate" value="4"><i></i>
                                            <input type="radio" name="rate" value="5"><i></i>
                                        </span>
                                    </td>
                                    <td colspan="2">
                                        <textarea name="content" id="" cols="50" required></textarea>
                                    </td>
                                    <td colspan="3">
                                        <input class="buy-btn" type="submit">
                                    </td>
                                </form>

                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
            
        </div>
    </div>
</div>
<script>
    var cd = {!! json_encode(strtotime($transaction->timeout)) !!}
    var idTransaction = {!! json_encode($transaction->id) !!}
    var status = {!! json_encode($transaction->status) !!}

    if(status == 'pending' || status == 'admin_notverified' || status == 'unpaid'){
        var countDownDate = new Date(cd * 1000).getTime();
    // Set the date we're counting down to
    // var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
        console.log(idTransaction);
        // Update the count down every 1 second
        var x = setInterval(function() {
        
        // Get today's date and time
        var now = new Date().getTime();
        
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
        
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            $.ajax({
                type:'POST',
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                url:'/expired/'+idTransaction,
                data:'_token = <?php echo csrf_token() ?>',
                // success:function(data) {
                //     $("#msg").html(data.msg);
                // }
            });
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
        }, 1000);
    }
    
</script>
{{-- <script>
// Set the date we're counting down to
var cd = {!! json_encode(strtotime($transaction->timeout)) !!}
var cd2 = {!! json_encode(strtotime($transaction->created_at)) !!}

    var countDownDate = new Date(cd * 1000).getTime();
    
    // var now = new Date().getTime();
    console.log(countDownDate);

    // Update the count down every 1 second
    var x = setInterval(function() {

    // Get today's date and time
    var now = new Date(cd2 * 1000).getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";

    // If the count down is finished, write some text
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
    }, 1000);
</script> --}}
<!-- end cart -->
<!-- end advertisement section -->
@endsection