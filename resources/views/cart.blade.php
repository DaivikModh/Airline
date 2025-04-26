@extends('master')
@section('content')

<?php $total = 0; ?>
<section class="portfolio py-5">
    <div class="container py-xl-5 py-lg-3">
        <div class="title-section text-center mb-md-5 mb-4">
            <h3 class="w3ls-title mb-3">{{ session('full_name') }}'s <span>Cart</span></h3>
            <p class="titile-para-text mx-auto">Here are the items in your cart.</p>
        </div>
        
        <div class="row mt-4">
            @foreach($cartItems as $item)
                <div class="col-md-4">
                    <div class="gallery-demo">
                            <img src="images/medicine.avif" alt=" " class="img-fluid" />
                            <h4 class="p-mask">{{ $item->name }} - <span>Rs {{ $item->price_per_pack }}</span></h4>
                            <div class="d-flex">
                                <p class="m-2">Quantity: {{ $item->quantity }} </p>
                                <p class="m-2">Total: {{ $value = $item->quantity *  $item->price_per_pack }}</p>
                                <?php $total += $value ?>
                            </div>
                     
                            <span class="w-4">
                                <a style="font-size: 30px;" href="{{route('addqty',['cart_id' => $item->cart_id])}}"><button class="btn btn-primary">+</button></a>
                                <a style="font-size: 30px;" href="{{route('remqty',['cart_id'=>$item->cart_id])}}"><button class="btn btn-danger">-</button></a>
                            </span>
                        <form action="{{ route('removecart', ['id' => $item->cart_id]) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                Remove
                            </button>
                        </form>

                        <button type="submit" class="btn btn-primary">
                            Buy
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div>
        <h3>Total: </h3>
        <h4><?php echo $total ?></h4>
    </div>
</section>

@stop