@extends('master')
@section('content')
<div class="container mt-5">
	<h1>Medicine Shop</h1>
	<h3>This are the medicines we recommend you purchase while travelling</h3>
<div class="row mt-4">
      @foreach($shop_list as $item)
				<div class="col-md-4">
					<div class="gallery-demo">

							<img src="images/medicine.avif" alt="medicine" class="img-fluid" />
							<h4 class="p-mask">{{$item->name}} - <span>Rs {{$item->price_per_pack}}</span></h4>
					<div><b><u>Use:</u></b> {{ $item->uses}}</div>
						<a href="{{route('addcart',['id'=>$item->id])}}">Add to Cart</a>
                        <button type="submit" class="btn btn-primary">Buy</button>
					</div>
				</div>
                @endforeach
    </div>
    </div>
</div>

@endsection