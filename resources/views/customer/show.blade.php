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
                                                    <li><i class="fa fa-money-check" style="color: #A16CE6;"></i> {{ $wisata->price }}</li>
                                                    <li><i class="fa fa-heart" style="color: red;"></i> 41</li>
                                                    <li><i class="fa fa-star" style="color: orange;"></i> 5.0</li>
                                                </ul>
                                                <p>{{ $wisata->description }}</p>
                                                <ul class="info">
                                                    <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Toilet</li>
                                                    <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Mushola</li>
                                                    <li><i class="fa-solid fa-square-check" style="color: #A16CE6;"></i>Kantin</li>
                                                </ul>
                                                <div class="d-flex align-items-center" style="margin-top: 20px;">
                                                    <button class="btn btn-primary px-3 me-2" style="color: white; background-color:#A16CE6;"
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="quantity" min="0" name="quantity" value="1" type="number"
                                                        class="form-control text-center" style="width: 60px; margin-top:1px;" />
                                                    <button class="btn btn-primary px-3 ms-2" style="color: white; background-color:#A16CE6;"
                                                        onclick="document.getElementById('quantity').stepUp()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <a href="{{ route('customer.summary', ['wisata_id' => $wisata->id, 'quantity' => '1']) }}"
                                                       class="btn btn-primary ms-2" style="color: white; background-color:#A16CE6;" id="orderButton">Order</a>
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
</div>

<script>
    document.getElementById('orderButton').addEventListener('click', function(event) {
        event.preventDefault();
        var quantity = document.getElementById('quantity').value;
        var url = this.href + '&quantity=' + quantity;
        window.location.href = url;
    });
</script>
@endsection
