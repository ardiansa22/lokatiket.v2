@extends('customer.layouts.app')
@section('style')
<style>
    .container{
        padding-bottom:60px;
    }
    .booking-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        margin: 16px;
        background-color: #fff;
    }

    .booking-card img {
        width: 100%;
        border-radius: 8px;
    }

    .room-info {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
    }

    .label {
        flex: 1;
        font-weight: bold;
    }

    .value {
        flex: 2;
    }

    .review {
        background-color: #ffff;
        padding: 16px;
        border-radius: 8px;
        margin-top: 16px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow */
    }

    .review .rating {
        background-color: #FFCB05;
        color: black;
        /* font-weight:bold; */
        border-radius: 50%;
        padding: 8px;
        font-size: 24px;
        width: 48px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
@endsection

@section('content')
<div class="container">
    @if($order->isEmpty())
        <p class="text-center">Tidak ada riwayat pesanan yang ditemukan.</p>
    @else
        @foreach($order as $item)
            <div class="booking-card">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('storage/images/' . json_decode($item->wisata->images)[0]) }}" alt="Samanea Boutique Apartment">
                    </div>
                    <div class="col-md-8 mt-1">
                        <h4 style="color:#0046bf;font-weight:bold;">{{ $item->wisata->name }}</h4>
                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i> Garut, Jawabarat</p>
                        <div class="room-info">
                            <div class="info-item">
                                <span class="label" style="color:#0046bf;font-weight:bold;">Harga</span>
                                <span class="value" style="color:#0046bf;">Rp. {{ number_format($item->total_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="label" style="color:#0046bf;font-weight:bold;">Tanggal Kunjungan</span>
                                <span class="value" style="color:#0046bf;">{{ $item->visit_date}}</span>
                            </div>
                            <div class="info-item">
                                <span class="label" style="color:#0046bf;font-weight:bold;">Tanggal Pembelian</span>
                                <span class="value" style="color:#0046bf;">{{ $item->created_at}}</span>
                            </div>
                            <div class="info-item">
                                <span class="label" style="color:#0046bf;font-weight:bold;">Tiket</span>
                                <span class="value"><a href="/customer/invoice/{{ $item->id }}"><span class="badge" style="background-color:#FFCB05;">Lihat Tiket</span></a></span>
                            </div>
                            <div class="info-item" style="color:#0046bf;font-weight:bold;">
                                <span class="label">Ulasan</span>
                                <span class="value">
                                    @if($item->ulasans->isEmpty())
                                        <a href="javascript:void(0);" class="tambah-ulasan" data-id="{{ $item->id }}" data-wisata-id="{{ $item->wisata_id }}">
                                            <span class="badge" style="background-color:#0046bf;">Tambah Ulasan</span>
                                        </a>
                                        <p class="text-muted mt-2">Anda belum mengisi ulasan untuk pesanan ini.</p>
                                    @else
                                        @foreach($item->ulasans as $ulasan)
                                        <div class="review">
                                            <div class="d-flex align-items-center">
                                                <div class=" mr-3">
                                                    @for ($i = 0; $i < $ulasan->rating; $i++)
                                                        <i class="fa fa-star" style="color:#FFCB05;"></i>
                                                    @endfor
                                                    <p class="text-muted">"{{ $ulasan->komentar }}"</p>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<!-- Modal -->
<div class="modal fade" id="ulasanModal" tabindex="-1" aria-labelledby="ulasanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ulasanModalLabel" style="color:#0046bf;font-weight:bold;">Tambah Ulasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/customer/ulasan" method="POST">
                    @csrf
                    <input type="hidden" name="wisata_id" id="modalWisataId">
                    <input type="hidden" name="order_id" id="modalOrderId">
                    <div class="form-group">
                        <label for="rating" style="color:#0046bf;font-weight:bold;">Rating</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="komentar" style="color:#0046bf;font-weight:bold;">Komentar</label>
                        <textarea name="komentar" id="komentar" class="form-control" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<script>
    $(document).ready(function() {
        $('.tambah-ulasan').on('click', function() {
            var wisataId = $(this).data('wisata-id');
            var orderId = $(this).data('id');
            $('#modalWisataId').val(wisataId);
            $('#modalOrderId').val(orderId);
            $('#ulasanModal').modal('show');
        });
    });
</script>
@endsection
