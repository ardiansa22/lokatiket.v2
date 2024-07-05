@extends('customer.layouts.app')

@section('content')
<div class="container">
    <div class="visit-country">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="items">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="item">
                                    <div class="row">
                                        <div class="col-lg-8 col-sm-5">
                                            <div class="image-slider">
                                                @foreach(json_decode($wisata->images) as $image)
                                                <div class="slide">
                                                    <img src="{{ asset('storage/images/' . $image) }}" alt="">
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-7">
                                            <div class="right-content">
                                                <h4>{{ $wisata->name }}</h4>
                                                <span>{{ $wisata->kategori }}</span>
                                                <ul class="info">
                                                    <li><i class="fa fa-money-check" style="color: #007BFF;"></i> {{ $wisata->price }}</li>
                                                    <li><i class="fa fa-star" style="color: orange;"></i> 5.0</li>
                                                </ul>
                                                <p>{{ $wisata->description }}</p>
                                                <ul class="info">
                                                    <li><i class="fa-solid fa-square-check" style="color: #007BFF;"></i>Toilet</li>
                                                    <li><i class="fa-solid fa-square-check" style="color: #007BFF;"></i>Mushola</li>
                                                    <li><i class="fa-solid fa-square-check" style="color: #007BFF;"></i>Kantin</li>
                                                </ul>
                                                <div class="d-flex align-items-center" style="margin-top: 20px;">
                                                    <button class="btn btn-primary px-3 me-2" style="color: white; background-color:#007BFF;"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="quantity" min="0" name="quantity" value="1" type="number"
                                                        class="form-control text-center" style="width: 60px; margin-top:1px;" />
                                                    <button class="btn btn-primary px-3 ms-2" style="color: white; background-color:#007BFF;"
                                                        onclick="document.getElementById('quantity').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <form id="checkout-form" action="{{route('customer.checkout')}}" method="POST" style="margin-top: 10px;">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                    <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">
                                                    <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                                    <input type="hidden" name="total_price" id="total_price" value="{{ $wisata->price }}">
                                                    <div class="">
                                                    <input type="date" name="visit_date">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Checkout</button>
                                                </form>
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
    </div>
</div>

<script>
    document.getElementById('quantity').addEventListener('change', function() {
        document.getElementById('hiddenQuantity').value = this.value;
        document.getElementById('total_price').value = this.value * {{ $wisata->price }};
    });

    document.getElementById('checkout-form').addEventListener('submit', function() {
        document.getElementById('hiddenQuantity').value = document.getElementById('quantity').value;
        document.getElementById('total_price').value = document.getElementById('quantity').value * {{ $wisata->price }};
    });
</script>
@endsection
