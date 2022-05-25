<div class="row">
    <div class="col-lg-8">
        <div class="checkout-accordion-wrap">
            <div class="accordion" id="accordionExample">
              <div class="card single-accordion">
                <div class="card-header" id="headingOne">
                  <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Shipping Address
                    </button>
                  </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="billing-address-form">
                        <form wire:submit.prevent="transaction" action="{{ route('user.transaction.save') }}" method="post">
                            @csrf
                            <p>
                                <textarea wire:model="address" name="address" id="address" cols="30" rows="10" placeholder="Home Address" required></textarea>
                            </p>
                            {{-- <p><input value="{{ $weight }}" type="text" placeholder="Shipping Cost Will be Displayed Here"></p> --}}
                            <p>
                                <select wire:model="province_destination" name="province_destination" required>
                                    <option value="">-- Province destination --</option>
                                    @foreach($provinces as $province)
                                        <option value={{ $province->id }}>{{ $province->province }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p>
                                <select wire:model="city_destination" name="city_destination" required>
                                    <option value="">-- City destination --</option>
                                    @foreach($cities as $key => $city)
                                        <option value={{ $city->id }}>{{ $city->city_name }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p>
                                <select wire:model = "courier" name="courier" required>
                                    <option value="">-- Courier Selection --</option>
                                    @foreach($couriers as $courier)
                                        <option value={{ $courier->courier }}>{{ $courier->courier }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p>
                                <select wire:model = "package" name="package" required>
                                    <option value="">-- Shipping Package --</option>
                                    @foreach($shipping as $ships)
                                        <option value="{{ $ships['service'] }}">{{ $ships['service'] }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p><input value="{{ $costDetail }}" type="text" placeholder="Shipping Cost Will be Displayed Here" disabled required></p>
                            
                    </div>
                    <div class="card-details">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                            <tr class="table-head-row">
                                                <th class="product-image">Product Image</th>
                                                <th class="product-image">Product</th>
                                                <th class="product-price">Price</th>
                                                <th class="product-quantity">Quantity</th>
                                                <th class="product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(empty($dataId))
                                                @foreach ($data as $datas)
                                                <tr class="table-body-row">
                                                    <td class="product-image">
                                                        @if(!empty($datas->products->images->first()->image_name))
                                                            <img src="{{ URL::asset('admin/product/'.$datas->products->images->first()->image_name) }}" alt=""></a>
                                                        @endif
                                                    </td>
                                                    <td class="product-name">{{ $datas->products->product_name }}</td>
                                                    <td class="product-price">
                                                        @if(!empty($datas->products->discounts)) 
                                                            Rp. {{ number_format($datas->products->price - ($datas->products->price * $datas->products->discounts->percentage/100)) }}
                                                        @else 
                                                            {{ number_format($datas->products->price) }}
                                                        @endif
                                                    </td>
                                                    <td class="product-quantity">
                                                        <input type="number" class="text-center" style="max-width: 50px" value="{{ $datas->qty }}" disabled>
                                                    </td>
                                                    <td class="product-total">
                                                        @if(!empty($datas->products->discounts)) 
                                                            Rp. {{ number_format(($datas->products->price - ($datas->products->price * $datas->products->discounts->percentage/100))*$datas->qty) }}
                                                        @else 
                                                            Rp. {{ number_format($datas->products->price*$datas->qty) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr class="table-body-row">
                                                    <td class="product-image">
                                                        @if(!empty($data->images->first()->image_name))
                                                            <img src="{{ URL::asset('admin/product/'.$data->images->first()->image_name) }}" alt=""></a>
                                                        @endif
                                                    </td>
                                                    <td class="product-name">{{ $data->product_name }}</td>
                                                    <td class="product-price">
                                                        @if(!empty($data->discounts)) 
                                                            Rp. {{ number_format($data->price - ($data->price * $data->discounts->percentage/100)) }}
                                                        @else 
                                                            Rp. {{ number_format($data->price) }}
                                                        @endif
                                                    </td>
                                                    <td class="product-quantity">
                                                        <a href="javascript:void(0)" wire:click="subtractSingle"><i class="fa fa-minus"></i></a>
                                                        <input type="number" class="text-center" style="max-width: 50px" min="1" value="{{ $singleQty }}" disabled>
                                                        <a href="javascript:void(0)" wire:click="addSingle"><i class="fa fa-plus"></i></a>
                                                    </td>
                                                    <td class="product-total">
                                                        @if(!empty($data->discounts)) 
                                                            Rp. {{ number_format(($data->price - ($data->price * $data->discounts->percentage/100))*$singleQty) }}
                                                        @else 
                                                            Rp. {{ number_format($data->price * $singleQty) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
    </div>

    <div class="col-lg-4">
        <div class="order-details-wrap">
            <table class="order-details">
                <thead>
                    <tr>
                        <th>Your order Details</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody class="checkout-details">
                    <tr>
                        <td>Total</td>
                        <td>Rp. {{ number_format($grand_total); }}</td>
                    </tr>
                    <tr>
                        <td>Shipping Cost ({{ $grand_sum / 1000 }} Kg)</td>
                        <td>Rp. {{ number_format($costDetail); }}</td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>Rp. {{ number_format($grand_total+$costDetail) }}</td>
                    </tr>
                </tbody>
            </table>
                <button class="cart-btn" type="submit">>> Place Order <<</button>
                        
            </form>
            {{-- <a href="#" class=""</a> --}}
        </div>
    </div>
</div>